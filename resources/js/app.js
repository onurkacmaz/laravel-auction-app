import './bootstrap';
import Alpine from 'alpinejs';
import 'font-awesome/css/font-awesome.min.css';
import './quill'
import './filepond'
import 'sweetalert2/src/sweetalert2.scss'
import Swal from 'sweetalert2/dist/sweetalert2'
import PhotoSwipeLightbox from "photoswipe/lightbox";
import PhotoSwipe from "photoswipe";
import "photoswipe/dist/photoswipe.css";

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
    '/resources/fonts/**',
    '/resources/image/**',
])

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$('.add-favorite').on('click', function (e) {
    e.preventDefault()
    const id = $(this).data('id');
    const isFavorite = parseInt($(this).data('is-favorite'));

    axios.post('/auctions/product/favorite/' + id, {
        isFavorite: isFavorite
    }).then(r => {
        if(isFavorite) {
            $(this).children('div').find('i').addClass('text-gray-500')
            $(this).children('div').find('i').removeClass('text-red-600')
        }else {
            $(this).children('div').find('i').removeClass('text-gray-500')
            $(this).children('div').find('i').addClass('text-red-600')
        }
        $(this).data('is-favorite', isFavorite ? 0 : 1)
        $(this).children('div').find('span').text(r.data.data.count)
    }).catch(e => {
        Toast.fire({
            icon: 'error',
            title: e.response.data.message
        })
    })
});
$('.follow').on('click', function (e) {
    e.preventDefault()
    const id = $(this).data('id');
    const isFollow = parseInt($(this).data('is-follow'));

    axios.post('/auctions/product/follow/' + id, {
        isFollow: isFollow
    }).then(r => {
        if(isFollow) {
            $(this).children('div').find('i').addClass('text-gray-500')
            $(this).children('div').find('i').removeClass('text-red-600')
        }else {
            $(this).children('div').find('i').removeClass('text-gray-500')
            $(this).children('div').find('i').addClass('text-red-600')
        }
        $(this).data('is-follow', isFollow ? 0 : 1)
        $(this).children('div').find('span').text(r.data.data.count)
    }).catch(e => {
        Toast.fire({
            icon: 'error',
            title: e.response.data.message
        })
    })
});
$('.bidding').on('click', function (e) {
    e.preventDefault()
    const id = parseInt($(this).data('id'));
    const bid_amount = $(this).parent().children('input').val()

    axios.post('/auctions/product/' + id + '/bidding', {
        bid_amount: bid_amount
    }).then(r => {
        Toast.fire({
            icon: 'success',
            title: r.data.data.message
        })
        $('.a' + id).text(r.data.data.end_price)
    }).catch(e => {
        Toast.fire({
            icon: 'error',
            title: e.response.data.message
        })
    })
});
$('.share').on('click', function (e) {
    e.preventDefault()
    const url = $(this).data('url');

    $('.modal-body').html('<div class="flex flex-row">\n' +
        '                                        <iframe src="https://www.facebook.com/plugins/share_button.php?href='+url+'&layout=button&size=large&width=77&height=28&appId" width="77" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>\n' +
        '                                        <a target="_blank" class="ml-2 px-4 twitter-share-button justify-center items-center flex bg-[#1d9bf0] text-white rounded-lg text-center font-semibold text-lg"\n' +
        '                                           href="https://twitter.com/intent/tweet?text='+url+'"\n' +
        '                                           data-size="large">\n' +
        '                                            <i class="fa fa-twitter fa-lg"></i>\n' +
        '                                            <span class="ml-2">Paylaş</span>\n' +
        '                                        </a>\n' +
        '                                    </div>')
    $('.share-modal').removeClass('hidden')
})
$('#share-modal-backdrop').on('click', function (e) {
    e.preventDefault()
    $('.share-modal').addClass('hidden')
})
$('.share-close-modal').on('click', function (e) {
    e.preventDefault()
    $('.share-modal').addClass('hidden')
})

new PhotoSwipeLightbox({
    gallery: '#product-primary-image',
    children: 'a',
    pswpModule: PhotoSwipe,
    loop: true,
    wheelToZoom: true
}).init();

$('#product-thumb-image > a').on('click', function (e) {
    e.preventDefault()
    $('#product-primary-image > a').addClass('hidden')
    $('.p-' + $(this).attr('href')).removeClass('hidden')
})
