Dropzone.autoDiscover = false;
Dropzone.prototype.defaultOptions.dictDefaultMessage = "Yüklemek istediğiniz dosyaları bu alana sürükleyin.";
Dropzone.prototype.defaultOptions.dictFallbackMessage = "Bu işlemi tarayıcınız desteklemiyor.";
Dropzone.prototype.defaultOptions.dictFileTooBig = "Dosya boyutu ({{filesize}}MB). Max. Dosya boyutu: {{maxFilesize}}MB.";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "Bu dosya türüne izin verilmemektedir.";
Dropzone.prototype.defaultOptions.dictResponseError = "Sunucu hata kodu: {{statusCode}}";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "Daha fazla dosya yükleyemezsiniz.";
Dropzone.prototype.defaultOptions.dictRemoveFile = "Sil";
Dropzone.prototype.defaultOptions.dictCancelUpload = "İptal et";
Dropzone.prototype.defaultOptions.dictUploadCanceled = "Yükleme iptal edildi";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Yüklemeyi iptal etmek istediğinize emin misiniz?";

var mydropzone, mydropzonelist = [], aimages, aimages2, aimages3;
var socket, cards, interval;

function socketChannel(params){
    
    if($(".socket").length < 1){
        clearInterval(interval);
        return false;
    }

    cards = "";

    // CONNECTION
    socket = io("s1.digitalfikirler.com:3000");

    // TO SERVER
    socket.emit("channel", params);

    // FROM SERVER
    socket.on("rows", (arg) => {

        if(arg.length < 1){
            return false;
        }
        
        arg.forEach(element => {
            
            cards += `<ul class="list-group w-100">
                <li class="list-group-item question-bubble ${ element.sender == "0" ? "right" : "left" }">
                    <div class="container my-3">
                        <div class="row font-weight-bold mb-3">
                            ${ element.sender == "0" ? `${ element.name } ${ element.surname }` : element.gallery_name }
                        </div>
                        <div class="row mb-3">
                            ${ element.message }
                        </div>
                        <div class="row d-flex justify-content-end text-muted small">
                            ${ moment(element.sended).format('L LT') }
                        </div>
                    </div>
                </li>
            </ul>`;

        });

        $(".chat .chat-body").html(cards);

    });

}

function fancyClose() {
    $("div#form-modal-content").removeClass("d-flex");
}

(function($){

    const Sergikur = {
        
        admin: {
            ids: ["5", "6", "7", "8"],
            activated: 0
        },
        minFiles: 1,
        requestURL: "https://s1.digitalfikirler.com/sergikur/requests.php",

        post: (form) => {
            return new Promise((resolve, reject) => {
                if(!(form instanceof FormData)) {
                    $.post(Sergikur.requestURL, form, (response) => resolve(response));
                    return false;
                }
                $.ajax({ type: "POST", url: Sergikur.requestURL, data: form, processData: false, contentType: false, success: (response) => resolve(response) });
            });
        },

        waitForSelector: async function(target){
            return new Promise(function(resolve){
                let timeout = 0;
                let interval = setInterval(function(){
                    timeout++;
                    if($(target).length > 0){
                        clearInterval(interval);
                        resolve(true);
                    }else{
                        if(timeout == 10){
                            clearInterval(interval);
                            resolve(false);
                        }
                    }
                }, 500);
            });
        },

        datatable: (target, form) => {
                    
            $(target).DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json'
                },
                columnDefs: [ { orderable: false }],
                paging: true,
                serverSide: true,
                serverMethod: 'post',
                ajax: {
                    type: "POST",
                    url: Sergikur.requestURL,
                    data: form,
                    error: (response) => {
                        console.log(response.responseText);
                    },
                    /*success: (response) => {
                        console.log(response);
                    }*/
                }
            });
            
        },

        dropzone: (target, form, settings) => {

            mydropzone = new Dropzone(target, { 
                url: Sergikur.requestURL,
                method: 'post',
                timeout: 12000000,
                params: form,
                headers: {
                    'Cache-Control': null,
                    'X-Requested-With': null,
                },
                init: function() {		
                    
                    if(typeof aimages2 != 'undefined') {
                        if(aimages2.length > 0) {
                            let thumbnail;
                            for (i = 0; i < aimages2.length; i++) {
                                if(typeof aimages3[i] != 'undefined') {
                                    $(target + " .dz-message").remove();
                                    thumbnail = aimages3[i];
                                    if(aimages3[i].indexOf(".pdf") > -1){
                                        thumbnail = "https://s1.digitalfikirler.com/sergikur/assets/pdf-ico.png";
                                    }
                                    this.emit("addedfile", aimages2[i]);
                                    this.emit("thumbnail", aimages2[i], thumbnail);
                                    this.emit("complete", aimages2[i]);
                                    aimages2[i].custom = aimages3[i];
                                    this.files.push(aimages2[i]);
                                }
                            }
                        }
                    }

                    this.on("successmultiple", function(file, response) {
                        response = JSON.parse(response);
                        for(var key in file) {
                            for(var key2 in response) {
                                if(file[key].name == response[key2].oldFile) {
                                    file[key].custom = response[key2].newFile;
                                }
                            }
                        }
                        $(target + " .dz-message").hide();
                        $('form button').attr("disabled", false).removeClass("disabled");							
                    });
                    
                    this.on("success", function(file, response) {
                        response = JSON.parse(response);
                        file.custom = response[0].newFile;
                        $(target + " .dz-message").hide();	
                        $('form button').attr("disabled", false).removeClass("disabled");						
                    });

                },
                sending: function(file) {				
                    $(target + " .dz-message").remove();				
                },
                removedfile: function (file) {		
                    $(file.previewElement).remove();				
                    if($(target + " .dz-preview").length == 0) {
                        $(target).html('<div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Görsel yüklemek için tıklayın.</span></div>');
                        $(target + " .dz-message").show();
                    }
                    $.ajax({                
                        type: "POST",
                        url: Sergikur.requestURL,
                        data: "action=21&filename=" + file.custom,
                        success: function(response) {				
                                                    
                        }					
                    });										
                },
                error: function(file, message) {	
                    Swal.fire("Bilgilendirme", message, "info");		
                    $(file.previewElement).remove();				
                    if($(target + " .dz-preview").length == 0) {
                        $(target + " .dz-message").show();
                    }										
                },
                accept: function(file, done) {				
                    /**if(typeof fileList[file.name] != 'undefined') {
                        done("Bu görseli daha önce yüklediniz.");
                        return false;
                    }**/		
                    $('form button').attr("disabled", true).addClass("disabled");		
                    done();				
                },
                resizeMethod: 'crop',
                uploadMultiple: true,
                addRemoveLinks: true,
                acceptedFiles: settings.acceptedFiles,
                maxFiles: settings.maxFiles,
                parallelUploads: settings.maxFiles,
                maxFilesize: settings.maxFilesize
            });

            mydropzonelist.push(mydropzone);
            
        },

        numberFormat: (number, decimals, dec_point, thousands_sep) => {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        },

        init: () => {

            if(visitor.id === ""){
                return false;
            }

            if($.inArray(visitor.id, Sergikur.admin.ids) > -1){
                Sergikur.admin.activated = 1;
            }
            
            if(location.href.indexOf("/sayfa/panel") > -1){
                Sergikur.modules.panel.init();
            }

            if(location.href.indexOf("/urun") > -1){
                Sergikur.modules.product();
            }

            if(location.href.indexOf("/hesabim") > -1){
                Sergikur.modules.account();
            }

        },

        modules: {

            product: () => {

                /** CALCULATE COMMISSION START */

                let priceWithCommission = $(".product-price-old:visible").text().replace("TRY", "").replace(".", "").replace(",", ".").trim();
                $(".product-button-box:visible .other-text div:contains('Toplam Fiyat') b").text(`TRY ${ Sergikur.numberFormat(priceWithCommission, 2, ",", ".") }`);

                let productPrice = priceWithCommission / 1.09 / 1.18;
                $(".product-price-old:visible").text(`TRY ${ Sergikur.numberFormat(productPrice, 2, ",", ".") }`)

                let commission = (priceWithCommission - (priceWithCommission / 1.09)) / 1.18;
                $(".product-button-box:visible .other-text div:contains('Komisyon')").text(`Hizmet Bedeli: TRY ${ Sergikur.numberFormat(commission, 2, ",", ".") }`);

                let taxofcommission = priceWithCommission - (priceWithCommission / 1.09) - (priceWithCommission - (priceWithCommission / 1.09)) / 1.18;
                let tax = ((priceWithCommission / 1.09) - productPrice) + taxofcommission;
                $(".product-button-box:visible .other-text div:contains('KDV')").text(`KDV: TRY ${ Sergikur.numberFormat(tax, 2, ",", ".") }`);

                /** CALCULATE COMMISSION END */

                /** CHANNEL START */

                $(document).on("click", "[data-selector='form-modal-content']", async (e) => {
                    
                    let form = new FormData();
                    form.append("channel", 0);
                    form.append("customer_id", visitor.id);
                    form.append("gallery_id", visitor.gallery);
                    
                    const response = await Sergikur.post(form);
                    $("#form-modal-content").html(response).addClass("d-flex");
                    
                });
                
                $(document).on("click", ".chat .chat-header", async (e) => {
                    
                    if($(e.currentTarget).parent().find(".chat-body").hasClass("d-none") == false && $(e.currentTarget).parent().find(".chat-footer").hasClass("d-none") == false){
                        $(e.currentTarget).parent().find(".chat-body, .chat-footer").addClass("d-none");
                        $("#form-modal-content").attr("style", "min-height:0;");
                    }
                    else{
                        $(e.currentTarget).parent().find(".chat-body, .chat-footer").removeClass("d-none")
                        $("#form-modal-content").removeAttr("style");
                    }

                });

                let subject = "";
                $(document).on("click", "[data-selector='add-new-subject']", async (e) => {

                    if($(e.currentTarget).parents(".chat-footer").find("[name='newSubject']").length < 1){
                        $(e.currentTarget).parents(".chat-footer").html(`
                            <div class="form-group w-100">
                                <label>Yeni Konu</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control mr-3" name="newSubject" />
                                    <a href="javascript:void(0);" class="btn btn-primary d-flex justify-content-center align-items-center w-25" data-selector="add-new-subject">
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>
                            </div>
                        `);
                        return false;
                    }
                    
                    if($("[name='newSubject']").val() == ""){
                        return false;
                    }

                    subject = $("[name='newSubject']").val();
                    
                    let form = new FormData();
                    form.append("channel", 1);
                    form.append("customer_id", visitor.id);
                    form.append("gallery_id", visitor.gallery);
                    form.append("new_subject", 1);
                    form.append("subject", subject);

                    const response = await Sergikur.post(form);
                    $("#form-modal-content").html(response);
                    

                });

                $(document).on("click", ".chat .list-group-item.subject-selections:not([data-selector='add-new-subject'])", async (e) => {
                    
                    let form = new FormData();
                    form.append("channel", 1);
                    form.append("customer_id", visitor.id);
                    form.append("gallery_id", visitor.gallery);
                    form.append("new_subject", 0);
                    form.append("subject", $(e.currentTarget).text().trim());

                    const response = await Sergikur.post(form);
                    $("#form-modal-content").html(response);

                });

                $(document).on("submit", "[name='sendMessage']", async (e) => {

                    if(!$(e.currentTarget).valid()) return false;

                    $(e.currentTarget).append(`<input name="channel" type="hidden" value="3" />`);
                    $(e.currentTarget).append(`<input name="sender" type="hidden" value="0" />`);
                    $(e.currentTarget).append(`<input name="customer_id" type="hidden" value="${ visitor.id }" />`);
                    $(e.currentTarget).append(`<input name="name" type="hidden" value="${ visitor.name }" />`);
                    $(e.currentTarget).append(`<input name="surname" type="hidden" value="${ visitor.surname }" />`);
                    $(e.currentTarget).append(`<input name="gallery_id" type="hidden" value="${ visitor.gallery }" />`);
                    $(e.currentTarget).append(`<input name="subject" type="hidden" value="${ subject }" />`);

                    await Sergikur.post($(e.currentTarget).serialize());
                    $("[name='message']").val(null);

                });

                /** CHANNEL END */

            },

            account: () => {

                let clone = $(".quick-menu-box:eq(0)").parent().clone();
                $(clone).find("a").attr("href", "/sayfa/panel");
                (Sergikur.admin.activated === 0) ? $(clone).find("a").attr("title", "Galerim") : $(clone).find("a").attr("title", "Galeriler");
                (Sergikur.admin.activated === 0) ? $(clone).find("a > h4").text("Galerim") : $(clone).find("a > h4").text("Galeriler");
                $(clone).find(".fa-address-card").removeAttr("class").addClass("fa fa-bars");
                $(".quick-menu-box:eq(0)").parent().before($(clone));

                /** CHANNEL START */

                let clone2 = $(".member-block a[href='/hesabim/iletisim-tercihlerim']").parent().clone();
                $(clone2).find("a").attr("id", "channel").attr("href", "/hesabim#iletisim").attr("title", "Sorularım").html(`
                    <i class="left-icons fa fa-paper-plane"></i>İletişim`);
                $(".member-block a[href='/hesabim/iletisim-tercihlerim']").parent().last().before($(clone2));
                
                if(location.href.indexOf("#iletisim") > -1){
                    setTimeout(() => {
                        $("#channel")[0].click();
                    }, 250);
                }

                if(Sergikur.admin.activated === 0){

                    $(document).on("click", "#channel", async (e) => {

                        let form = new FormData();
                        form.append("channel", 4);
                        form.append("customer_id", visitor.id);

                        const response = await Sergikur.post(form);
                        $(".contentbox-body").parent().html(response);

                        if($(".dataTable").length > 0) return false;
                        $(".dt-customer").length > 0 ? Sergikur.datatable("table", { channel: 5, customer_id: visitor.id }) : Sergikur.datatable("table", { channel: 6, customer_id: visitor.id });

                    });

                }
                else{

                    $(document).on("click", "#channel", async (e) => {

                        let form = new FormData();
                        form.append("channel", 9);

                        const response = await Sergikur.post(form);
                        $(".contentbox-body").parent().html(response);

                        if($(".dataTable").length > 0) return false;
                        Sergikur.datatable("table", { channel: 10 })

                    });

                }

                $(document).on("click", "[data-selector='form-modal-content']", async (e) => {

                    let form = new FormData();
                    form.append("channel", 7);
                    form.append("admin", Sergikur.admin.activated);
                    form.append("chat_id", $(e.currentTarget).attr("data-chat-id"));

                    const response = await Sergikur.post(form);
                    $("#form-modal-content").addClass("d-flex").html(response);

                });

                $(document).on("click", ".chat .chat-header", async (e) => {
                    
                    if($(e.currentTarget).parent().find(".chat-body").hasClass("d-none") == false && $(e.currentTarget).parent().find(".chat-footer").hasClass("d-none") == false){
                        $(e.currentTarget).parent().find(".chat-body, .chat-footer").addClass("d-none");
                        $("#form-modal-content").attr("style", "min-height:0;");
                    }
                    else{
                        $(e.currentTarget).parent().find(".chat-body, .chat-footer").removeClass("d-none")
                        $("#form-modal-content").removeAttr("style");
                    }

                });

                $(document).on("submit", "[name='sendMessage']", async (e) => {

                    if(!$(e.currentTarget).valid()) return false;

                    $(e.currentTarget).append(`<input name="channel" type="hidden" value="8" />`);
                    $(e.currentTarget).append(`<input name="sender" type="hidden" value="${ $(".dt-customer").length > 0 ? 1 : 0 }" />`);
                    $(e.currentTarget).append(`<input name="customer_id" type="hidden" value="${ visitor.id }" />`);
                    $(e.currentTarget).append(`<input name="name" type="hidden" value="${ visitor.name }" />`);
                    $(e.currentTarget).append(`<input name="surname" type="hidden" value="${ visitor.surname }" />`);

                    await Sergikur.post($(e.currentTarget).serialize());
                    $("[name='message']").val(null);

                });
                
                /** CHANNEL END */
                
            },

            panel: {

                init: async () => {

                    let form = new FormData();
                    form.append("action", 0);
                    form.append("admin", Sergikur.admin.activated);
    
                    const response = await Sergikur.post(form);
                    $(".contentbox-body").html(response);

                    Sergikur.modules.panel.eventlistener();

                    if(Sergikur.admin.activated === 0){
                        $("[data-selector='customer-gallery']").trigger("click");
                    }
                    
                },

                eventlistener: async () => {

                    // CUSTOMER

                    $(document).on("click", "[data-selector='customer-gallery']", async (e) => {
                        
                        let form = new FormData();
                        form.append("action", 1);
                        form.append("admin", Sergikur.admin.activated);
                        form.append("customer_id", visitor.id);

                        const response = await Sergikur.post(form);
                        $("[data-wrapper='page-content']").html(response);

                        $('.date').mask('00/00/0000', { placeholder: "GG/AA/YYYY" });
                        $('.phone').mask('0(000) 000 00 00', { placeholder: "0(___) ___ __ __" });

                        $(".dropzone").parents(".col-12:eq(0)").html(`
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">
                                        Kimlik Beyanı
                                    </label>
                                    <p class="text-muted mb-3">En az 1 adet döküman ekleyiniz. Döküman olarak .pdf kullanabilirsiniz.</p>
                                    <div class="dropzone d-flex justify-content-center align-items-center" id="operatingCertificate">
                                        <div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Döküman yüklemek için tıklayın.</span></div>
                                    </div>
                                    <input type="hidden" name="document" value="">
                                </div>
                            </div>
                        </div>`);

                        mydropzonelist = [];
                                    
                        $(".dropzone").each((index, item) => {
                            
                            if(typeof aimagesGallery !== "undefined"){
                                aimages2 = [aimagesGallery[index]];
                                aimages3 = [aimagesGallery2[index]];
                            }

                            Sergikur.dropzone(`#${ $(item).attr("id") }`, {
                                fsaction: 1
                            }, {
                                acceptedFiles: "application/pdf,image/jpeg,image/png",
                                maxFiles: 1,
                                maxFilesize: 5
                            });

                        });

                    });

                    $(document).on("click", "[data-selector='add-new-product']", async (e) => {

                        let form = new FormData();
                        form.append("action", 2);
                        form.append("admin", Sergikur.admin.activated);
                        form.append("customer_id", visitor.id);

                        const response = await Sergikur.post(form);
                        $("[data-wrapper='page-content']").html(response);
                        aimages = undefined;
                        aimages2 = undefined;
                        aimages3 = undefined;
                        setTimeout(() => {
                            Sergikur.dropzone(".dropzone", {
                                fsaction: 0
                            }, {
                                acceptedFiles: "image/jpeg,image/png",
                                maxFiles: 4,
                                maxFilesize: 2
                            });
                            $("select").select2({
                                tags: true
                            });
                        }, 250);

                    });

                    $(document).on("click", "[data-selector='customer-products']", async (e) => {
                        
                        let form = new FormData();
                        form.append("action", 3);
                        form.append("admin", Sergikur.admin.activated);
                        form.append("customer_id", visitor.id);

                        const response = await Sergikur.post(form);
                        $("[data-wrapper='page-content']").html(response);

                        Sergikur.datatable("table", { dtaction: 1, customer_id: visitor.id });

                    });

                    $(document).on("submit", "[name='galleryApplication']", async (e) => {

                        if(!$(e.currentTarget).valid()){
                            return false;
                        }

                        let identifiy = $("[name='Identification']");
                        let identifiyParent = identifiy.parent();
                        let identifiyLabel = identifiyParent.find("label.error");
                        if(identifiy.val().length < 11 || identifiy.val().length > 11){
                            identifiyLabel.length > 0 ? identifiyLabel.removeAttr("style").text("Kimlik no hatalı.") : identifiyParent.append(`<label id="Identification-error" class="error" for="Identification">Kimlik no hatalı.</label>`);
                            $([document.documentElement, document.body]).animate({
                                scrollTop: identifiy.offset().top
                            }, 500);
                            return false;
                        }
                        else if($("[name='Identification']").val().substring(10) % 2 !== 0){
                            identifiyLabel.length > 0 ? identifiyLabel.removeAttr("style").text("Kimlik no hatalı.") : identifiyParent.append(`<label id="Identification-error" class="error" for="Identification">Kimlik no hatalı.</label>`);
                            $([document.documentElement, document.body]).animate({
                                scrollTop: identifiy.offset().top
                            }, 500);
                            return false;
                        }

                        let documents = [];
                        let err = false;
                        for (let index = 0; index < mydropzonelist.length; index++) {
                            if(mydropzonelist[index].files.length < 1) {
                                err = mydropzonelist[index].element;
                                break;
                            }
                            if(mydropzonelist[index].files[0].custom.indexOf("https://") > -1){
                                    documents.push(mydropzonelist[index].files[0].custom.split("documents/")[1]);
                            }else{
                                documents.push(mydropzonelist[index].files[0].custom);
                            }
                            
                        }
                        $("input[name=document]").val(encodeURIComponent(documents.join(";")));

                        if(err !== false){
                            Swal.fire({
                                icon: "warning",
                                title: "Uyarı",
                                html: `<b>${ $(err).parents(".form-group:eq(0)").find("label").text().trim() }</b> yükleyiniz.`,
                                confirmButtonText: "Tamam"
                            })
                            return false;
                        }

                        let swalData = {
                            customClass: {
                                confirmButton: 'btn btn-success btn-loading bg-transparent disabled border-0'
                            },
                            title: 'Lütfen bekleyiniz!',
                            text: 'Galeri başvurunuz oluşturuluyor.',
                            imageUrl: 'https://s1.digitalfikirler.com/sergikur/assets/logo.webp',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Logo',
                            confirmButtonText: '',
                            allowOutsideClick: false
                        };

                        if($(e.currentTarget).find("[name='application_type']").val() === "update"){
                            swalData["text"] = "Galeri başvurunuz güncelleniyor.";
                        }
                        Swal.fire(swalData);

                        $(e.currentTarget).append(`<input name="action" type="hidden" value="4" />`);
                        $(e.currentTarget).append(`<input name="customer_id" type="hidden" value="${ visitor.id }" />`);
                        $(e.currentTarget).append(`<input name="admin" type="hidden" value="${ Sergikur.admin.activated }" />`);

                        const response = await Sergikur.post($(e.currentTarget).serialize());
                        $(e.currentTarget).removeClass("btn-loading disabled").removeAttr("disabled");

                        if(response === "1"){
                            setTimeout(() => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Galeri Başvurunuz Alındı.",
                                    confirmButtonText: "Tamam",
                                    preConfirm: () => {
                                        location.reload();
                                    }
                                });
                            }, 1500);
                        }
                        else if(response === "2"){
                            setTimeout(() => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Başvurunuz Güncellendi.",
                                    confirmButtonText: "Tamam",
                                    preConfirm: () => {
                                        location.reload();
                                    }
                                });
                            }, 1500);
                        }

                    });

                    $(document).on("submit", "[name='productApplication']", async (e) => {

                        if(!$(e.currentTarget).valid()){
                            return false;
                        }

                        if(mydropzone.files.length == 0) {
                            Swal.fire("Bilgilendirme", "Lütfen en az bir ürün görseli yükleyiniz.", "info");
                            return false;
                        }
                        let image = "";
                        for(var key in mydropzone.files) {
                            if(key == 0) {
                                image += mydropzone.files[key].custom;
                            }
                            else {
                                image += ';' + mydropzone.files[key].custom;
                            }
                        }
                        $("input[name=image]").val(encodeURIComponent(image));

                        Swal.fire({
                            customClass: {
                                confirmButton: 'btn btn-success btn-loading bg-transparent disabled border-0'
                            },
                            title: 'Lütfen bekleyiniz!',
                            text: 'Eser başvurunuz oluşturuluyor.',
                            imageUrl: 'https://s1.digitalfikirler.com/sergikur/assets/logo.webp',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Logo',
                            confirmButtonText: '',
                            allowOutsideClick: false
                        });

                        $(e.currentTarget).append(`<input name="action" type="hidden" value="5" />`);
                        $(e.currentTarget).append(`<input name="customer_id" type="hidden" value="${ visitor.id }" />`);
                        $(e.currentTarget).append(`<input name="admin" type="hidden" value="${ Sergikur.admin.activated }" />`);

                        const response = await Sergikur.post($(e.currentTarget).serialize());
                        $(e.currentTarget).removeClass("btn-loading disabled").removeAttr("disabled");
                        
                        if(response === "1"){
                            setTimeout(() => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Eser Başvurunuz Alındı.",
                                    confirmButtonText: "Tamam",
                                    preConfirm: () => {
                                        $("[data-selector='customer-products']").trigger("click");
                                    }
                                });
                            }, 1500);
                        }
                        else {
                            setTimeout(() => {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Eser Kodu Mevcut.",
                                    text: "Aynı eser kodu ile tek bir eser gönderilebilir.",
                                    confirmButtonText: "Tamam"
                                });
                            }, 1500);
                        }

                    });

                    $(document).on("click", "[data-selector='customer-product-edit']", async (e) => {

                        let form = new FormData();
                        form.append("action", 6);
                        form.append("admin", Sergikur.admin.activated);
                        form.append("product_id", $(e.currentTarget).attr("data-product-id"));

                        const response = await Sergikur.post(form);
                        $("[data-wrapper='page-content']").html(response);

                        Sergikur.dropzone(".dropzone", {
                            fsaction: 0
                        }, {
                            acceptedFiles: "image/jpeg,image/png",
                            maxFiles: 4,
                            maxFilesize: 2
                        });

                    });

                    $(document).on("submit", "[name='productEdit']", async (e) => {

                        if(!$(e.currentTarget).valid()){
                            return false;
                        }

                        if(mydropzone.files.length == 0) {
                            Swal.fire("Bilgilendirme", "Lütfen en az bir ürün görseli yükleyiniz.", "info");
                            return false;
                        }

                        let image = "";
                        for(var key in mydropzone.files) {
                            if(key == 0) {
                                if(mydropzone.files[key].custom.indexOf("https://") > -1){
                                    image += mydropzone.files[key].custom.split("images/")[1];
                                }else{
                                    image += mydropzone.files[key].custom;
                                }
                            }
                            else {
                                if(mydropzone.files[key].custom.indexOf("https://") > -1){
                                    image += ';' + mydropzone.files[key].custom.split("images/")[1];
                                }else{
                                    image += ';' + mydropzone.files[key].custom;
                                }
                            }
                        }
                        $("input[name=image]").val(encodeURIComponent(image));

                        $(e.currentTarget).append(`<input name="action" type="hidden" value="7" />`);
                        $(e.currentTarget).append(`<input name="customer_id" type="hidden" value="${ visitor.id }" />`);
                        $(e.currentTarget).append(`<input name="product_id" type="hidden" value="${ $(e.currentTarget).attr("data-product-id") }" />`);
                        $(e.currentTarget).append(`<input name="admin" type="hidden" value="${ Sergikur.admin.activated }" />`);

                        const response = await Sergikur.post($(e.currentTarget).serialize());
                        $(e.currentTarget).removeClass("btn-loading disabled").removeAttr("disabled");

                        if(response === "1"){

                            Swal.fire({
                                icon: "success",
                                title: "Eser Bilgileriniz Güncellenmiştir.",
                                text: "Onay süreci ardından eseriniz tekrardan yayına alınacaktır.",
                                showCancelButton: false,
                                confirmButtonText: "Tamam",
                            });

                        }
                        else if(response === "2"){

                            Swal.fire({
                                icon: "success",
                                title: "Eser Fiyat / Stok Bilgileriniz Güncellenmiştir.",
                                showCancelButton: false,
                                confirmButtonText: "Tamam",
                            });

                        }

                    });

                    $(document).on("click", "[data-selector='product-remove']", async (e) => {

                        let productId = $(e.currentTarget).attr("data-product-id");

                        Swal.fire({
                            customClass: { confirmButton: 'swal2-danger', denyButton: 'swal2-success', cancelButton: 'swal2-secondary' },
                            title: "Eser İşlemleri",
                            text: "Lütfen bir işlem seçiniz.",
                            showConfirmButton: true,
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Tamamen Kaldır",
                            denyButtonText: "Geçici Olarak Kaldır",
                            cancelButtonText: "Vazgeç",
                            preConfirm: async () => {

                                let form = new FormData();
                                form.append("action", 8);
                                form.append("product_id", productId);
                                form.append("admin", 0);

                                $(".swal2-confirm, .swal2-deny, .swal2-cancel").addClass("btn-loading");
                                let response = await Sergikur.post(form);

                                if(response === "1"){

                                    Swal.fire({
                                        icon: "success",
                                        title: "Eseriniz Tamamen Silindi.",
                                        text: "Eseriniz site üzerinden tamamen silinmiştir.",
                                        showCancelButton: false,
                                        confirmButtonText: "Tamam",
                                        preConfirm: () => {
                                            location.reload();
                                        }
                                    });
        
                                }

                            }
                        }).then(async (result) => {

                            if (result.isDenied) {
                                
                                let form = new FormData();
                                form.append("action", 9);
                                form.append("product_id", productId);
                                form.append("admin", 0);

                                $(".swal2-confirm, .swal2-deny, .swal2-cancel").addClass("btn-loading");
                                let response = await Sergikur.post(form);
                                
                                if(response === "1"){

                                    Swal.fire({
                                        icon: "success",
                                        title: "Eseriniz Yayından Kaldırılmıştır.",
                                        text: "Eseriniz sadece yayından kaldırılmıştır.",
                                        showCancelButton: false,
                                        confirmButtonText: "Tamam",
                                        preConfirm: () => {
                                            location.reload();
                                        }
                                    });
        
                                }

                            }

                        });

                    });

                    $(document).on("click", "[data-selector='customer-product-update']", async (e) => {

                        let self = $(e.currentTarget);
                        let productId = self.attr("data-product-id");

                        Swal.fire({
                            customClass: { confirmButton: 'swal2-danger', denyButton: 'swal2-success', cancelButton: 'swal2-secondary' },
                            title: "Eser İşlemleri",
                            text: "Lütfen bir işlem seçiniz.",
                            showConfirmButton: true,
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Tamamen Güncelle / Yayına Al",
                            denyButtonText: "Fiyat / Stok Güncelle",
                            cancelButtonText: "Vazgeç",
                            preConfirm: async () => {
                                Swal.fire({
                                    title: "Onay",
                                    text: "Eser için onay süreci tekrar başlatılacaktır.",
                                    showCancelButton: true,
                                    confirmButtonText: "Onayla",
                                    cancelButtonText: "Vazgeç",
                                    preConfirm: () => {
                                        self.before(`<input name="update-type" type="hidden" value="0" />`);
                                        $("[name='productEdit']").submit();
                                    }
                                });
                            }
                        }).then(async (result) => {

                            if (result.isDenied) {
                                self.before(`<input name="update-type" type="hidden" value="1" />`);
                                $("[name='productEdit']").submit();
                            }

                        });

                    });

                    $(document).on("click", "[data-selector='see-rejection-detail-1']", async (e) => {

                        let productId = $(e.currentTarget).attr("data-product-id");
                        
                        let form = new FormData();
                        form.append("action", 13);
                        form.append("product_id", productId);
                        form.append("admin", Sergikur.admin.activated);
                        
                        let response = await Sergikur.post(form);

                        Swal.fire({
                            title: "Red Sebebi",
                            text: response,
                            showCancelButton: false,
                            confirmButtonText: "Tamam",
                        });

                    });

                    // ADMIN

                    $(document).on("click", "[data-selector='galleries']", async (e) => {
                        
                        let form = new FormData();
                        form.append("action", 1);
                        form.append("admin", Sergikur.admin.activated);

                        const response = await Sergikur.post(form);
                        $("[data-wrapper='page-content']").html(response);

                        Sergikur.datatable("table", { dtaction: 0 });

                    });

                    $(document).on("click", "[data-selector='gallery-details']", async (e) => {
                        
                        let form = new FormData();
                        form.append("action", 2);
                        form.append("customer_id", $(e.currentTarget).attr("data-gallery-id"));
                        form.append("admin", Sergikur.admin.activated);

                        const response = await Sergikur.post(form);
                        Swal.fire({
                            html: response,
                            confirmButtonText: "Tamam"
                        });

                    });

                    $(document).on("click", "[data-selector='gallery-proggress']", async (e) => {

                        let galleryId = $(e.currentTarget).attr("data-gallery-id");

                        Swal.fire({
                            customClass: { confirmButton: 'swal2-success', denyButton: 'swal2-danger', cancelButton: 'swal2-secondary' },
                            title: "Galeri İşlemleri",
                            text: "Lütfen bir işlem seçiniz.",
                            showConfirmButton: true,
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Onayla",
                            denyButtonText: "Reddet",
                            cancelButtonText: "Vazgeç",
                            preConfirm: async () => {

                                let form = new FormData();
                                form.append("action", 3);
                                form.append("customer_id", galleryId);
                                form.append("admin", Sergikur.admin.activated);

                                await Sergikur.post(form);
                                location.reload();

                            }
                        }).then((result) => {

                            if (result.isDenied) {
                                
                                Swal.fire({
                                    customClass: { confirmButton: 'swal2-danger' },
                                    html: `<div class="form-group mt-5">
                                        <label>Red Sebebi</label>
                                        <textarea class="form-control" data-selector="reason-for-rejection" placeholder="Lütfen bir red sebebi giriniz."></textarea>
                                    </div>`,
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: "Galeri Red",
                                    cancelButtonText: "Vazgeç",
                                    preConfirm: async () => {

                                        let reasonForRejection = $("[data-selector='reason-for-rejection']");

                                        if(reasonForRejection.val() === ""){
                                            $(".swal2-validation-message").text("Red sebebi boş bırakılamaz.");
                                            $(".swal2-validation-message").addClass("text-center").removeAttr("style");
                                            return false;
                                        }

                                        let form = new FormData();
                                        form.append("action", 4);
                                        form.append("customer_id", galleryId);
                                        form.append("admin", Sergikur.admin.activated);
                                        form.append("reason_for_rejection", reasonForRejection.val());

                                        await Sergikur.post(form);
                                        location.reload();

                                    }
                                });

                            }

                        });

                    });
                    
                    $(document).on("click", "[data-selector='see-rejection-detail']", async (e) => {

                        let galleryId = $(e.currentTarget).attr("data-gallery-id");
                        
                        let form = new FormData();
                        form.append("action", 5);
                        form.append("customer_id", galleryId);
                        form.append("admin", Sergikur.admin.activated);
                        
                        let response = await Sergikur.post(form);

                        Swal.fire({
                            title: "Red Sebebi",
                            text: response,
                            showCancelButton: false,
                            confirmButtonText: "Tamam",
                        });

                    });

                    $(document).on("click", "[data-selector='products']", async (e) => {
                        
                        let form = new FormData();
                        form.append("action", 6);
                        form.append("admin", Sergikur.admin.activated);

                        const response = await Sergikur.post(form);
                        $("[data-wrapper='page-content']").html(response);

                        Sergikur.datatable("table", { dtaction: 2 });

                    });

                    $(document).on("click", "[data-selector='product-details']", async (e) => {
                        
                        let form = new FormData();
                        form.append("action", 7);
                        form.append("product_id", $(e.currentTarget).attr("data-product-id"));
                        form.append("admin", Sergikur.admin.activated);

                        const response = await Sergikur.post(form);
                        Swal.fire({
                            html: response,
                            confirmButtonText: "Tamam"
                        });

                    });

                    $(document).on("click", "[data-selector='product-proggress']", async (e) => {

                        let productId = $(e.currentTarget).attr("data-product-id");

                        Swal.fire({
                            customClass: { confirmButton: 'swal2-success', denyButton: 'swal2-danger', cancelButton: 'swal2-secondary' },
                            title: "Eser İşlemleri",
                            text: "Lütfen bir işlem seçiniz.",
                            showConfirmButton: true,
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Onayla",
                            denyButtonText: "Reddet",
                            cancelButtonText: "Vazgeç",
                            preConfirm: async () => {

                                $(".swal2-confirm, .swal2-deny, .swal2-cancel").addClass("btn-loading");

                                let form = new FormData();
                                form.append("action", 8);
                                form.append("product_id", productId);
                                form.append("admin", Sergikur.admin.activated);

                                await Sergikur.post(form);
                                location.reload();

                            }
                        }).then((result) => {

                            if (result.isDenied) {
                                
                                Swal.fire({
                                    customClass: { confirmButton: 'swal2-danger' },
                                    html: `<div class="form-group mt-5">
                                        <label>Red Sebebi</label>
                                        <textarea class="form-control" data-selector="reason-for-rejection" placeholder="Lütfen bir red sebebi giriniz."></textarea>
                                    </div>`,
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: "Eser Red",
                                    cancelButtonText: "Vazgeç",
                                    preConfirm: async () => {

                                        let reasonForRejection = $("[data-selector='reason-for-rejection']");

                                        if(reasonForRejection.val() === ""){
                                            $(".swal2-validation-message").text("Red sebebi boş bırakılamaz.");
                                            $(".swal2-validation-message").addClass("text-center").removeAttr("style");
                                            return false;
                                        }

                                        let form = new FormData();
                                        form.append("action", 9);
                                        form.append("product_id", productId);
                                        form.append("admin", Sergikur.admin.activated);
                                        form.append("reason_for_rejection", reasonForRejection.val());

                                        $(".swal2-confirm, .swal2-deny, .swal2-cancel").addClass("btn-loading");

                                        await Sergikur.post(form);
                                        location.reload();

                                    }
                                });

                            }

                        });

                    });

                    $(document).on("click", "[data-selector='see-rejection-detail-2']", async (e) => {

                        let productId = $(e.currentTarget).attr("data-product-id");
                        
                        let form = new FormData();
                        form.append("action", 10);
                        form.append("product_id", productId);
                        form.append("admin", Sergikur.admin.activated);
                        
                        let response = await Sergikur.post(form);

                        Swal.fire({
                            title: "Red Sebebi",
                            text: response,
                            showCancelButton: false,
                            confirmButtonText: "Tamam",
                        });

                    });

                    // CUSTOM

                    $(document).on("click", "[name='individual'], [name='institutional']", (e) => {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    });

                    $(document).on("click", "label.individual, label.institutional", (e) => {
                        
                        $(e.currentTarget).parents(".row:eq(0)").find("[type='radio']:checked")[0].checked = false;
                        $(e.currentTarget).parent().find("[type='radio']")[0].checked = true;

                        let billType = $(e.currentTarget).parents(".row:eq(0)").find("[type='radio']:checked").attr("name");
                        if(billType === "individual"){

                            $("div.institutional").addClass("d-none");
                            $(".dropzone").parents(".col-12:eq(0)").html(`
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">
                                            Kimlik Beyanı
                                        </label>
                                        <p class="text-muted mb-3">En az 1 adet döküman ekleyiniz. Döküman olarak .pdf kullanabilirsiniz.</p>
                                        <div class="dropzone d-flex justify-content-center align-items-center">
                                            <div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Döküman yüklemek için tıklayın.</span></div>
                                        </div>
                                        <input type="hidden" name="document" value="">
                                    </div>
                                </div>
                            </div>`);

                            Sergikur.dropzone(".dropzone", {
                                fsaction: 1
                            }, {
                                acceptedFiles: "application/pdf,image/jpeg,image/png",
                                maxFiles: 1,
                                maxFilesize: 5
                            });

                        }else {

                            $("div.institutional").removeClass("d-none");
                            /*$(".dropzone").parent().find(".text-muted").text("En az 3 adet döküman ekleyiniz. Döküman olarak .pdf kullanabilirsiniz.");
                            $(".dropzone").after(`<div class="dropzone d-flex justify-content-center align-items-center">
                                <div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Döküman yüklemek için tıklayın.</span></div>
                            </div>`)
                            $(".dropzone:eq(0)").remove();*/
                            setTimeout(() => {
                                $(".dropzone").parents(".col-12:eq(0)").html(`
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">
                                                    Vergi Levhası
                                                </label>
                                                <p class="text-muted mb-3">En az 1 adet döküman ekleyiniz. Döküman olarak .pdf kullanabilirsiniz.</p>
                                                <div class="dropzone d-flex justify-content-center align-items-center" id="taxBoard">
                                                    <div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Döküman yüklemek için tıklayın.</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">
                                                    Faaliyet Belgesi
                                                </label>
                                                <p class="text-muted mb-3">En az 1 adet döküman ekleyiniz. Döküman olarak .pdf kullanabilirsiniz.</p>
                                                <div class="dropzone d-flex justify-content-center align-items-center" id="operatingCertificate">
                                                    <div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Döküman yüklemek için tıklayın.</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">
                                                    İmza Sirküleri
                                                </label>
                                                <p class="text-muted mb-3">En az 1 adet döküman ekleyiniz. Döküman olarak .pdf kullanabilirsiniz.</p>
                                                <div class="dropzone d-flex justify-content-center align-items-center" id="signatureCirculars">
                                                    <div class="dz-message" data-dz-message><span style="color: #133167;"><i class="fas fa-image mr-2"></i>Döküman yüklemek için tıklayın.</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="document" value="">
                                    </div>`);

                                    mydropzonelist = [];
                                    
                                    $(".dropzone").each((index, item) => {
                                        
                                        aimages2 = [aimagesGallery[index]];
                                        aimages3 = [aimagesGallery2[index]];

                                        Sergikur.dropzone(`#${ $(item).attr("id") }`, {
                                            fsaction: 1
                                        }, {
                                            acceptedFiles: "application/pdf,image/jpeg,image/png",
                                            maxFiles: 1,
                                            maxFilesize: 5
                                        });

                                    });
                            }, 150);
                        }
                    });

                    $("[data-selector='galleries']").trigger("click");

                }

            }

        }

    };

    $(document).ready(Sergikur.init);

})(jQuery);