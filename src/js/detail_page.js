window.onload = () => {
    getPostData()
}

async function getPostData() {
    let id = new URLSearchParams(location.search).get('id')
    let params = {id}
    let res = await api('GET', 'getPost', params, false)

    if (res.error) {
        $('#error-message').text(res.error)
        $('#error-message').removeClass('hidden')
        $('#detail').addClass('hidden')
        return
    }

    $('#post-title').text(res.name)
    $('#post-created-at').text(dateBeautify(res.created_at))
    $('#post-updated-at').text(dateBeautify(res.updated_at))
    $('#post-url').attr('href', res.url)
    $('#like-button').html(getLikeButtonTemplate(res.id, res.is_liked, res.like_count, true, true))
    $('#route-image').attr('src', `/api/image.php?id=${res.id}`)
    $('#route-distance').text(distanceBeautify(res.distance))
    $('#route-duration').text(durationBeautify(res.duration))

    let timeDiff = new Date() - new Date(res.updated_at)
    let timeDiffYears = Math.floor(Math.abs(timeDiff) / (365 * 24 * 60 * 60 * 1000))

    if (timeDiffYears >= 1) {
        $('#old-route-alert').html($('#old-route-alert').html().replace('{years}', timeDiffYears))
        $('#old-route-alert').removeClass('hidden')
    }

    if (res.description) {
        $('#post-description').text(res.description)
    } else {
        $('#post-description-box').addClass('hidden')
    }
}