import PhotoSwipeLightbox from "photoswipe/lightbox";
import PhotoSwipe from "photoswipe";
import "photoswipe/dist/photoswipe.css";
import jQuery from 'jquery';
import 'slick-carousel'

window.$ = window.jQuery = jQuery;
setInterval(function () {
    axios.get('/auctions/product/' + id + '/bids' + window.location.search).then(r => {
        $('.bids').html(r.data.data.html)
    })
}, 3000)

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

$('.products-content').slick({
    infinite: false ,
    slidesPerRow: 1,
    arrows: true,
    slidesToShow: 4,
    nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right fa-2x"></i></button>',
    prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left fa-2x"></i></button>',
    dots:false,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
        }
    }, {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
        }
    }, {
        breakpoint: 300,
    }]
});
