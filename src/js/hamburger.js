$(document).ready(function () {
    $('.hamburger').click(function (e) {
        let menu = $(this).parent()
        let toggle = $('#hamburger-toggle')

        if (!toggle.hasClass('bars')) {
            toggle.removeClass('close')
            toggle.addClass('bars')
            menu.removeClass('open')
        } else {
            toggle.removeClass('bars')
            toggle.addClass('close')
            menu.addClass('open')
        }

        e.preventDefault()
    })
})