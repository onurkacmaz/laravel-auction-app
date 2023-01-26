import jQuery from 'jquery';
import Swal from "sweetalert2";

window.$ = window.jQuery = jQuery;

$('.delete-artwork').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Emin misiniz?',
        text: "Eser silinecek! Emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, Sil!',
        cancelButtonText: 'Hayır'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
})
