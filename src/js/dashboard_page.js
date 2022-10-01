async function renderingPosts(page = 1, search) {
    // APIから投稿を取得
    let params = { page }
    if (search) params['search'] = search
    let res = await api('GET', 'getPosts', params)
    let postsHtmlArray = res.posts.map(post => {
        return TABLE_TEMPLATE
            .replace(/%ROUTE_ID%/g, post.id)
            .replace(/%ROUTE_NAME%/g, post.todo)
            .replace(/%ROUTE_URL%/g, post.url)
            .replace(/%DETAIL_URL%/g, `/posts/detail.php?id=${post.id}`)
            .replace(/%ROUTE_UPDATED_AT%/g, post.updated_at)
            .replace(/%USER_ID%/g, post.user_id)
            .replace(/%DELETE_ACTION%/g, `showDeleteModal(${post.id})`)
            .replace(/%EDIT_ACTION%/g, `location.href = '/posts/editor.php?id=${post.id}'`)
    })

    // htmlとして追加
    $('#route-list').html(postsHtmlArray.join(''))

    // ページネーションを作成
    $('#pagination').html(getPaginationTemplate(res.count, page))
    $('#route-count').text(res.count ? `全${res.count}件中 ${1 + res.offset} ~ ${Math.min(10 + res.offset, res.count)}件目を表示中` : '投稿が見つかりませんでした。')
}

function showDeleteModal(id) {
    $('#deleteConfirmModal').modal('show')
    $('#delete-confirm-button').attr('onclick', `location.href = '/posts/delete.php?id=${id}'`)
}

window.onload = () => {
    $('#search-button').on('click', () => {
        let query = $('#search-input').val()
        renderingPosts(1, query)
    })

    renderingPosts()
}