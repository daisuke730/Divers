async function renderingPosts(page = 1, search) {
    // APIから投稿を取得
    let params = {page}
    if (search) params['search'] = search
    let res = await api('GET', 'getPosts', params)
    let postsHtmlArray = res.posts.map(post => {
        return CARD_TEMPLATE
            .replace(/%ROUTE_NAME%/g, post.name)
            .replace(/%ROUTE_ID%/g, post.id)
            .replace(/%ROUTE_CREATED_AT%/g, dateBeautify(post.updated_at))
            .replace(/%ROUTE_DESCRIPTION%/g, post.description)
            .replace(/%BUTTON_COMPONENT%/g, getLikeButtonTemplate(post.id, post.is_liked, post.like_count))
            .replace(/%MANAGE_COMPONENT%/g, post.can_edit ? getManageComponentTemplate(post.id) : '')
            .replace(/%THUMBNAIL_URL%/g, `/api/image.php?id=${post.id}`)
            .replace(/%ROUTE_DISTANCE%/g, distanceBeautify(post.distance))
            .replace(/%ROUTE_DURATION%/g, durationBeautify(post.duration))
    })

    // htmlとして追加
    $('#route-list').html(postsHtmlArray.join(''))

    // ページネーションを作成
    $('#pagination').html(getPaginationTemplate(page, res.count))

    $('#route-count').text(res.count ? `全${res.count}件中 ${1 + res.offset} ~ ${Math.min(10 + res.offset, res.count)}件目を表示中` : '投稿が見つかりませんでした。')
}

function showDeleteModal(id) {
    $('#deleteConfirmModal').modal('show')
    $('#delete-confirm-button').attr('onclick', `location.href = 'delete.php?id=${id}'`)
}

window.onload = () => {
    $('#search-button').on('click', () => {
        let query = $('#search-input').val()
        renderingPosts(1, query)
    })

    renderingPosts()
}