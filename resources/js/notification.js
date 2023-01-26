import jQuery from "jquery";

window.$ = window.jQuery = jQuery;

$(document).ready(function() {
    if (window.isLoggedId) {
        getNotifications()
    }

    $('.notification-b').click((e) => {
        e.preventDefault()
        $('.notification-c').fadeToggle(500)
        $('.n-overlay').fadeToggle(100)
    })

    $('.n-close').click((e) => {
        e.preventDefault()
        $('.notification-c').fadeToggle(500)
        $('.n-overlay').fadeToggle()
    })

    $('.n-overlay').click((e) => {
        e.preventDefault()
        $('.notification-c').fadeToggle(500)
        $('.n-overlay').fadeToggle()
    })

    $('.load-more').click((e) => {
        e.preventDefault()
        const currentPage = parseInt($(e.currentTarget).data('current-page'));
        getNotifications(currentPage + 1)
    })
})

function getNotifications(page = 1) {
    axios.get('/notifications', {
        params: {
            page: page
        }
    }).then(r => {
        window.notifications = r.data
        dispatchEvent(new CustomEvent('notification:load', {bubbles: true}))
    })
}

window.addEventListener("notification:click", (event) => {
    axios.post('/notifications/markAsRead/' + event.detail.id).then(r => {
        $('[data-count]').attr('data-count', r.data.count)
        $('.notification-item[data-id=' + event.detail.id + ']').removeClass('bg-gray-300')
        window.location.href = event.detail.href
    })
});

window.addEventListener('notification:load', (event) => {

    $('.notifications-content').append(window.notifications.html)
    $('[data-count]').attr('data-count', window.notifications.count)

    if (!window.notifications.hasMorePages) {
        $('.load-more').remove()
    }else {
        $('.load-more').attr('data-current-page', window.notifications.currentPage)
    }



    $('.notification-item').click((e) => {
        e.preventDefault()
        const id = $(e.currentTarget).data('id');
        const href = $(e.currentTarget).attr('href');
        dispatchEvent(new CustomEvent('notification:click', {bubbles: true, detail: {id: id, href: href}}))
    })
})
