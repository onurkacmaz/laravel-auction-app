import './bootstrap';
import Alpine from 'alpinejs';
import 'font-awesome/css/font-awesome.min.css';
import './quill'
import './filepond'
import jQuery from 'jquery';
import Swal, {Toast} from './sweeralert'
import hljs from 'highlight.js';
import 'highlight.js/styles/github.css';

window.$ = window.jQuery = jQuery;

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
    '/resources/fonts/**',
    '/resources/image/**',
])

$('.add-favorite').on('click', function (e) {
    e.preventDefault()
    const id = $(this).data('id');
    const isFavorite = parseInt($(this).data('is-favorite'));

    axios.post('/auctions/product/favorite/' + id, {
        isFavorite: isFavorite
    }).then(r => {
        if (isFavorite) {
            $(this).children('div').find('i').addClass('text-gray-500')
            $(this).children('div').find('i').removeClass('text-red-600')
            $('.add-favorite > i').addClass('far').removeClass('fas')
        } else {
            $(this).children('div').find('i').removeClass('text-gray-500')
            $(this).children('div').find('i').addClass('text-red-600')
            $('.add-favorite > i').addClass('fas').removeClass('far')
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
        if (isFollow) {
            $(this).children('div').find('i').addClass('text-gray-500')
            $(this).children('div').find('i').removeClass('text-red-600')
            $('.follow > i').removeClass('fas').addClass('far')
        } else {
            $(this).children('div').find('i').removeClass('text-gray-500')
            $(this).children('div').find('i').addClass('text-red-600')
            $('.follow > i').addClass('fas').removeClass('far')
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
        $('.bid' + id).text(r.data.data.bid_count)
    }).catch(e => {
        Toast.fire({
            icon: 'error',
            title: e.response.data.message
        })
    })
});

$('#bids-search').keyup(function () {
    const q = $(this).val()
    const params = new URLSearchParams(window.location.search);
    params.set('q', q)
    axios.get('/account/my-bids?' + params.toString()).then(r => {
        $('.my-bids').html(r.data.html)
    })
});

document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((el) => {
        hljs.highlightElement(el);
        $('.general-setting-input').on('change', function () {
            console.log($(this).val())
        })
    });
});
