@php use Illuminate\Support\Facades\Vite; @endphp
<header id="header">
    <div class="container">
        <div class="row align-items-center align-items-xl-end">
            <div class="order-1 col col-xl-2">
                <div class="logo">
                    <a href="/" aria-label="Logo">
                        <img
                            src="{{ Vite::asset('resources/image/logo.webp') }}"
                            alt="">
                    </a>
                </div>
            </div>
            <div class="order-2 col-xl-5 position-static d-none d-xl-block">
                <div class="header-menu-container">
                    <ul>
                        <li class="navigation-container">
                            <a href="javascript:void(0);" class="openbox" aria-label="Navigation"
                               data-target="navigation-content">
                                <span>SANAT ESERLERİ</span>
                            </a>
                            <div class="navigation-content openbox-content">
                                <div class="container">
                                    <nav id="navigation">
                                        <div class="category-level-1">
                                            <ul>
                                                <li class=" has-sub-category   active "
                                                    data-selector="first-level-navigation">
                                                    <a href="/kategori/painting" title="Temalar">
                                                        <span>Temalar</span>
                                                    </a>
                                                    <div class="sub-category category-level-2">
                                                        <ul>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/abstract-1" title="Figuratif">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/21/FotoJet.jpg?revision=1673001059"
                                                                            alt="Figuratif"/>
                                                                    </div>
                                                                    <span>Figuratif</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/pop-art" title="Pop Art">
                                                                    <div>
                                                                        <img
                                                                            src="//st2.myideasoft.com/idea/lc/38/myassets/categories/20/FotoJet (5).jpg?revision=1673000885"
                                                                            alt="Pop Art"/>
                                                                    </div>
                                                                    <span>Pop Art</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/fine-art" title="Nu">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/19/nu.jpg?revision=1673000904"
                                                                            alt="Nu"/>
                                                                    </div>
                                                                    <span>Nu</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/figurative" title="Perspektif">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/18/pers.jpg?revision=1673000989"
                                                                            alt="Perspektif"/>
                                                                    </div>
                                                                    <span>Perspektif</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/fantasy" title="Siyasi ve Tarihi">
                                                                    <div>
                                                                        <img
                                                                            src="//st1.myideasoft.com/idea/lc/38/myassets/categories/17/siyasi.jpg?revision=1673001009"
                                                                            alt="Siyasi ve Tarihi"/>
                                                                    </div>
                                                                    <span>Siyasi ve Tarihi</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/abstract" title="Spiritüel">
                                                                    <div>
                                                                        <img
                                                                            src="//st1.myideasoft.com/idea/lc/38/myassets/categories/16/spiritüel.jpg?revision=1673000862"
                                                                            alt="Spiritüel"/>
                                                                    </div>
                                                                    <span>Spiritüel</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/street-art" title="Peyzaj">
                                                                    <div>
                                                                        <img
                                                                            src="//st3.myideasoft.com/idea/lc/38/myassets/categories/15/FotoJet (4).jpg?revision=1673001089"
                                                                            alt="Peyzaj"/>
                                                                    </div>
                                                                    <span>Peyzaj</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/still-life" title="Portre">
                                                                    <div>
                                                                        <img
                                                                            src="//st3.myideasoft.com/idea/lc/38/myassets/categories/14/portre.jpg?revision=1673001269"
                                                                            alt="Portre"/>
                                                                    </div>
                                                                    <span>Portre</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/portrait" title="Enterior">
                                                                    <div>
                                                                        <img
                                                                            src="//st2.myideasoft.com/idea/lc/38/myassets/categories/13/FotoJet (2).jpg?revision=1673001294"
                                                                            alt="Enterior"/>
                                                                    </div>
                                                                    <span>Enterior</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/landscape" title="Hat ve Kaligrafi">
                                                                    <div>
                                                                        <img
                                                                            src="//st3.myideasoft.com/idea/lc/38/myassets/categories/11/FotoJet (3).jpg?revision=1673001315"
                                                                            alt="Hat ve Kaligrafi"/>
                                                                    </div>
                                                                    <span>Hat ve Kaligrafi</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/nude" title="Natürmort">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/12/natürmort.jpg?revision=1672998290"
                                                                            alt="Natürmort"/>
                                                                    </div>
                                                                    <span>Natürmort</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/everyday-life" title="Sürrealist">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/10/FotoJet (1).jpg?revision=1673001332"
                                                                            alt="Sürrealist"/>
                                                                    </div>
                                                                    <span>Sürrealist</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class=" has-sub-category  " data-selector="first-level-navigation">
                                                    <a href="/kategori/sculpture" title="Teknikler">
                                                        <span>Teknikler</span>
                                                    </a>
                                                    <div class="sub-category category-level-2">
                                                        <ul>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/yagli-boya" title="Yağlı Boya">
                                                                    <div>
                                                                        <img
                                                                            src="//st2.myideasoft.com/idea/lc/38/myassets/categories/32/yağli.jpg?revision=1673007347"
                                                                            alt="Yağlı Boya"/>
                                                                    </div>
                                                                    <span>Yağlı Boya</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/pastel" title="Pastel">
                                                                    <div>
                                                                        <img
                                                                            src="//st1.myideasoft.com/idea/lc/38/myassets/categories/30/pastel.jpg?revision=1673007360"
                                                                            alt="Pastel"/>
                                                                    </div>
                                                                    <span>Pastel</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/akrilik" title="Akrilik">
                                                                    <div>
                                                                        <img
                                                                            src="//st1.myideasoft.com/idea/lc/38/myassets/categories/23/akrilik.jpg?revision=1673003226"
                                                                            alt="Akrilik"/>
                                                                    </div>
                                                                    <span>Akrilik</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/test" title="Alkollü Mürekkep">
                                                                    <div>
                                                                        <img
                                                                            src="//st1.myideasoft.com/idea/lc/38/myassets/categories/22/mürekkep.jpg?revision=1673002109"
                                                                            alt="Alkollü Mürekkep"/>
                                                                    </div>
                                                                    <span>Alkollü Mürekkep</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/guaj" title="Guaj">
                                                                    <div>
                                                                        <img
                                                                            src="//st2.myideasoft.com/idea/lc/38/myassets/categories/24/guaj.jpg?revision=1673003257"
                                                                            alt="Guaj"/>
                                                                    </div>
                                                                    <span>Guaj</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/heykel" title="Heykel">
                                                                    <div>
                                                                        <img
                                                                            src="//st2.myideasoft.com/idea/lc/38/myassets/categories/26/heykel (1).jpg?revision=1673003402"
                                                                            alt="Heykel"/>
                                                                    </div>
                                                                    <span>Heykel</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/ilustrasyon" title="İllüstrasyon">
                                                                    <div>
                                                                        <img
                                                                            src="//st3.myideasoft.com/idea/lc/38/myassets/categories/25/ilust.jpg?revision=1673005726"
                                                                            alt="İllüstrasyon"/>
                                                                    </div>
                                                                    <span>İllüstrasyon</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/karakalem" title="Karakalem">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/27/kara.jpg?revision=1673005969"
                                                                            alt="Karakalem"/>
                                                                    </div>
                                                                    <span>Karakalem</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/karisik-teknik"
                                                                   title="Karışık Teknik">
                                                                    <div>
                                                                        <img
                                                                            src="//st3.myideasoft.com/idea/lc/38/myassets/categories/28/kar.jpg?revision=1673006429"
                                                                            alt="Karışık Teknik"/>
                                                                    </div>
                                                                    <span>Karışık Teknik</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/murekkep" title="Mürekkep">
                                                                    <div>
                                                                        <img
                                                                            src="//st3.myideasoft.com/idea/lc/38/myassets/categories/29/mürekkepğ.jpg?revision=1673006631"
                                                                            alt="Mürekkep"/>
                                                                    </div>
                                                                    <span>Mürekkep</span>
                                                                </a>
                                                            </li>
                                                            <li class="navigation-category-image">
                                                                <a href="/kategori/sulu-boya" title="Sulu Boya">
                                                                    <div>
                                                                        <img
                                                                            src="//st.myideasoft.com/idea/lc/38/myassets/categories/31/sulu (1).jpg?revision=1673007283"
                                                                            alt="Sulu Boya"/>
                                                                    </div>
                                                                    <span>Sulu Boya</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <script>
                                        var navigationMenu = {
                                            "settings": {
                                                "columnWidth": 0,
                                                "numberOfColumns": 0,
                                                "leftMargin": 0,
                                                "menuEffect": "fade",
                                                "openingEffect": "jswing",
                                                "closingEffect": "jswing",
                                                "openingSpeed": 0,
                                                "closingSpeed": 0,
                                                "useCategoryImage": 1,
                                                "hideThirdLevelCategories": 0,
                                                "thirdLevelCategoryCount": 0
                                            }, "categories": [{
                                                "id": 1,
                                                "name": "Temalar",
                                                "url": "\/kategori\/painting",
                                                "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/themes\/selftpl_63a0c6bbd7a25\/assets\/uploads\/nopic_image.png?revision=1673625689",
                                                "subCategories": [{
                                                    "id": 21,
                                                    "name": "Figuratif",
                                                    "url": "\/kategori\/abstract-1",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/21\/FotoJet.jpg?revision=1673001059",
                                                    "subCategories": []
                                                }, {
                                                    "id": 20,
                                                    "name": "Pop Art",
                                                    "url": "\/kategori\/pop-art",
                                                    "imageUrl": "\/\/st2.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/20\/FotoJet (5).jpg?revision=1673000885",
                                                    "subCategories": []
                                                }, {
                                                    "id": 19,
                                                    "name": "Nu",
                                                    "url": "\/kategori\/fine-art",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/19\/nu.jpg?revision=1673000904",
                                                    "subCategories": []
                                                }, {
                                                    "id": 18,
                                                    "name": "Perspektif",
                                                    "url": "\/kategori\/figurative",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/18\/pers.jpg?revision=1673000989",
                                                    "subCategories": []
                                                }, {
                                                    "id": 17,
                                                    "name": "Siyasi ve Tarihi",
                                                    "url": "\/kategori\/fantasy",
                                                    "imageUrl": "\/\/st1.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/17\/siyasi.jpg?revision=1673001009",
                                                    "subCategories": []
                                                }, {
                                                    "id": 16,
                                                    "name": "Spirit\u00fcel",
                                                    "url": "\/kategori\/abstract",
                                                    "imageUrl": "\/\/st1.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/16\/spiritu\u0308el.jpg?revision=1673000862",
                                                    "subCategories": []
                                                }, {
                                                    "id": 15,
                                                    "name": "Peyzaj",
                                                    "url": "\/kategori\/street-art",
                                                    "imageUrl": "\/\/st3.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/15\/FotoJet (4).jpg?revision=1673001089",
                                                    "subCategories": []
                                                }, {
                                                    "id": 14,
                                                    "name": "Portre",
                                                    "url": "\/kategori\/still-life",
                                                    "imageUrl": "\/\/st3.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/14\/portre.jpg?revision=1673001269",
                                                    "subCategories": []
                                                }, {
                                                    "id": 13,
                                                    "name": "Enterior",
                                                    "url": "\/kategori\/portrait",
                                                    "imageUrl": "\/\/st2.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/13\/FotoJet (2).jpg?revision=1673001294",
                                                    "subCategories": []
                                                }, {
                                                    "id": 11,
                                                    "name": "Hat ve Kaligrafi",
                                                    "url": "\/kategori\/landscape",
                                                    "imageUrl": "\/\/st3.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/11\/FotoJet (3).jpg?revision=1673001315",
                                                    "subCategories": []
                                                }, {
                                                    "id": 12,
                                                    "name": "Nat\u00fcrmort",
                                                    "url": "\/kategori\/nude",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/12\/natu\u0308rmort.jpg?revision=1672998290",
                                                    "subCategories": []
                                                }, {
                                                    "id": 10,
                                                    "name": "S\u00fcrrealist",
                                                    "url": "\/kategori\/everyday-life",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/10\/FotoJet (1).jpg?revision=1673001332",
                                                    "subCategories": []
                                                }]
                                            }, {
                                                "id": 2,
                                                "name": "Teknikler",
                                                "url": "\/kategori\/sculpture",
                                                "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/themes\/selftpl_63a0c6bbd7a25\/assets\/uploads\/nopic_image.png?revision=1673625689",
                                                "subCategories": [{
                                                    "id": 32,
                                                    "name": "Ya\u011fl\u0131 Boya",
                                                    "url": "\/kategori\/yagli-boya",
                                                    "imageUrl": "\/\/st2.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/32\/yag\u0306li.jpg?revision=1673007347",
                                                    "subCategories": []
                                                }, {
                                                    "id": 30,
                                                    "name": "Pastel",
                                                    "url": "\/kategori\/pastel",
                                                    "imageUrl": "\/\/st1.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/30\/pastel.jpg?revision=1673007360",
                                                    "subCategories": []
                                                }, {
                                                    "id": 23,
                                                    "name": "Akrilik",
                                                    "url": "\/kategori\/akrilik",
                                                    "imageUrl": "\/\/st1.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/23\/akrilik.jpg?revision=1673003226",
                                                    "subCategories": []
                                                }, {
                                                    "id": 22,
                                                    "name": "Alkoll\u00fc M\u00fcrekkep",
                                                    "url": "\/kategori\/test",
                                                    "imageUrl": "\/\/st1.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/22\/mu\u0308rekkep.jpg?revision=1673002109",
                                                    "subCategories": []
                                                }, {
                                                    "id": 24,
                                                    "name": "Guaj",
                                                    "url": "\/kategori\/guaj",
                                                    "imageUrl": "\/\/st2.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/24\/guaj.jpg?revision=1673003257",
                                                    "subCategories": []
                                                }, {
                                                    "id": 26,
                                                    "name": "Heykel",
                                                    "url": "\/kategori\/heykel",
                                                    "imageUrl": "\/\/st2.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/26\/heykel (1).jpg?revision=1673003402",
                                                    "subCategories": []
                                                }, {
                                                    "id": 25,
                                                    "name": "\u0130ll\u00fcstrasyon",
                                                    "url": "\/kategori\/ilustrasyon",
                                                    "imageUrl": "\/\/st3.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/25\/ilust.jpg?revision=1673005726",
                                                    "subCategories": []
                                                }, {
                                                    "id": 27,
                                                    "name": "Karakalem",
                                                    "url": "\/kategori\/karakalem",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/27\/kara.jpg?revision=1673005969",
                                                    "subCategories": []
                                                }, {
                                                    "id": 28,
                                                    "name": "Kar\u0131\u015f\u0131k Teknik",
                                                    "url": "\/kategori\/karisik-teknik",
                                                    "imageUrl": "\/\/st3.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/28\/kar.jpg?revision=1673006429",
                                                    "subCategories": []
                                                }, {
                                                    "id": 29,
                                                    "name": "M\u00fcrekkep",
                                                    "url": "\/kategori\/murekkep",
                                                    "imageUrl": "\/\/st3.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/29\/mu\u0308rekkepg\u0306.jpg?revision=1673006631",
                                                    "subCategories": []
                                                }, {
                                                    "id": 31,
                                                    "name": "Sulu Boya",
                                                    "url": "\/kategori\/sulu-boya",
                                                    "imageUrl": "\/\/st.myideasoft.com\/idea\/lc\/38\/myassets\/categories\/31\/sulu (1).jpg?revision=1673007283",
                                                    "subCategories": []
                                                }]
                                            }]
                                        };
                                    </script>

                                </div>
                            </div>
                        </li>
                        <li class="active">
                            <a href="#">
                                <span>MÜZAYEDELER</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>GÜNCEL ETKİNLİKLER</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="order-xl-3 order-4 col-xl-3">
                <div class="search">
                    <form action="" data-selector="search-form">
                        <input type="text" name="q" placeholder="" onfocus="this.placeholder = ''" aria-label="Search"
                               class="auto-complete">
                        <button>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21.779 20.6697L17.1358 16.0364C18.5454 14.3438 19.2482 12.1731 19.098 9.97556C18.9479 7.77807 17.9564 5.72305 16.3297 4.23798C14.703 2.75291 12.5664 1.95213 10.3644 2.00222C8.16232 2.0523 6.06435 2.94938 4.50687 4.50687C2.94938 6.06435 2.0523 8.16233 2.00222 10.3644C1.95213 12.5664 2.75291 14.703 4.23798 16.3297C5.72305 17.9564 7.77807 18.9479 9.97556 19.0981C12.173 19.2482 14.3438 18.5454 16.0363 17.1358L20.6697 21.7692C20.8147 21.9171 21.0123 22.0018 21.2194 22.0048C21.4296 22.0023 21.6304 21.9177 21.779 21.7692C21.9208 21.6213 22 21.4243 22 21.2194C22 21.0146 21.9208 20.8176 21.779 20.6697ZM10.5686 17.5579C8.71617 17.5538 6.94082 16.816 5.63096 15.5062C4.32111 14.1963 3.5834 12.421 3.57925 10.5686C3.5816 8.71652 4.31903 6.94112 5.62956 5.63244C6.94009 4.32375 8.71651 3.58881 10.5686 3.58907C12.421 3.58907 14.1975 4.32493 15.5073 5.63476C16.8171 6.94459 17.553 8.72111 17.553 10.5735C17.553 12.4259 16.8171 14.2024 15.5073 15.5122C14.1975 16.822 12.421 17.5579 10.5686 17.5579Z"
                                    fill="#252525"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="order-xl-4 order-3 col-auto col-xl-2">
                <div class="header-user-buttons">
                    @auth()
                        <div class="header-menu-container d-flex justify-content-end">
                            <ul>
                                <li class="navigation-container">
                                    <a href="{{ route('profile.edit') }}">
                                        <span class="pr-4">Hesabım</span>
                                        <i class="fas fa-2x fa-user-circle"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    @guest()
                        <div class="header-user-buttons">
                            <div>
                                <a href="{{route('login')}}">
                                    <svg width="40" height="20" viewBox="0 0 40 20" fill="none">
                                        <path d="M4 16L14 9.99998L4 4L4 16Z" fill="white"/>
                                        <path d="M36 16L26 9.99998L36 4L36 16Z" fill="white"/>
                                    </svg>
                                    <span>{{ __('messages.buy_sell_swap') }}</span>
                                </a>
                            </div>
                        </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</header>
