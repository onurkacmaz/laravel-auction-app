import jQuery from "jquery";

window.$ = window.jQuery = jQuery;
window.OneSignal = window.OneSignal || [];

if (window.isLoggedId) {
    getNotifications().finally(() => {
        dispatchEvent(new CustomEvent('notification:load', {bubbles: true}))
    })
    OneSignal.push(function() {
        OneSignal.init({
            appId: "0ca88ec3-cf2a-44cb-a0e6-a7c6a25c8146",
        });
    });
}

$('.notification-b').click((e) => {
    e.preventDefault()
    $('.notification-c').fadeToggle(500)
    $('.n-overlay').fadeToggle(100)
})

$('.n-close, .n-overlay').click((e) => {
    e.preventDefault()
    $('.notification-c').fadeToggle(500)
    $('.n-overlay').fadeToggle()
})

$('.load-more').click((e) => {
    e.preventDefault()
    const currentPage = parseInt($(e.currentTarget).data('current-page'));
    getNotifications(currentPage + 1).finally(() => {
        dispatchEvent(new CustomEvent('notification:load', {bubbles: true}))
    })
    dispatchEvent(new CustomEvent('notification:load', {bubbles: true}))
})

async function getNotifications(page = 1) {
    return axios.get('/notifications', {
        params: {
            page: page
        }
    }).then(r => {
        window.notifications = r.data
    })
}

window.addEventListener("notification:hover", (event) => {
    axios.post('/notifications/markAsRead/' + event.detail.id).then(r => {
        $('[data-count]').attr('data-count', r.data.count)
        $('.notification-item[data-id=' + event.detail.id + ']').removeClass('bg-gray-300').data('read', !event.detail.isRead)
    })
});

window.addEventListener('notification:load', (event) => {
    $('.notifications-content').append(window.notifications.html)
    $('[data-count]').attr('data-count', window.notifications.count)

    if (!window.notifications.hasMorePages) {
        $('.load-more').remove()
    } else {
        $('.load-more').attr('data-current-page', window.notifications.currentPage)
    }

    $('.notification-item').mouseenter((e) => {
        e.preventDefault()
        const id = $(e.currentTarget).data('id');
        const href = $(e.currentTarget).attr('href');
        const isRead = $(e.currentTarget).data('read')

        if (!isRead) {
            dispatchEvent(new CustomEvent('notification:hover', {
                bubbles: true,
                detail: {id: id, href: href, isRead: isRead}
            }))
        }
    })
})

window.addEventListener('notification:new', (event) => {
    $('.notifications-content').html('').append(window.notifications.html)
    $('[data-count]').attr('data-count', window.notifications.count)

    $('.notification-item').mouseenter((e) => {
        e.preventDefault()
        const id = $(e.currentTarget).data('id');
        const href = $(e.currentTarget).attr('href');
        const isRead = $(e.currentTarget).data('read')

        if (!isRead) {
            dispatchEvent(new CustomEvent('notification:hover', {
                bubbles: true,
                detail: {id: id, href: href, isRead: isRead}
            }))
        }
    })
})

OneSignal.on('notificationDisplay', function (event) {
    let currentPage = parseInt($('.load-more').data('current-page'));
    if (isNaN(currentPage)) {
        currentPage = 1
    }

    getNotifications(currentPage).finally(() => {
        dispatchEvent(new CustomEvent('notification:new', {bubbles: true}))
    })
});

OneSignal.on('subscriptionChange', function (isSubscribed) {
    if (isSubscribed) {
        OneSignal.setExternalUserId(window.userId);
    }
})
