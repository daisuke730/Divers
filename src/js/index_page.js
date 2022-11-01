const listStates = {
    search: null,
    sort: null
}

async function renderingPosts(page = 1) {
    // APIから投稿を取得
    let params = {page}
    if (listStates.search) params['search'] = listStates.search
    if (listStates.sort) params['sort'] = listStates.sort
    
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
    $('#delete-confirm-modal').modal({
        blurring: true,
        transition: 'fade up'
    }).modal('show')
    $('#delete-confirm-button').attr('onclick', `location.href = 'delete.php?id=${id}'`)
}

const sortOptions = [{
    name: '最終更新日が新しい順',
    value: 'updated_at',
    default: true
}, {
    name: 'いいね数が多い順',
    value: 'like_count'
}, {
    name: '距離が近い順',
    value: 'distance'
}, {
    name: '所要時間が短い順',
    value: 'duration'
}]

window.onload = () => {
    $('#open-search-modal').on('click', () => {
        if(!$('#sort-lists').html()) {
            let sortListsHtml = []
            for (let i = 0; i < sortOptions.length; i++) {
                sortListsHtml.push(getRadioButtonTemplate('sort-options', sortOptions[i].value, sortOptions[i].name, sortOptions[i].default, i))
            }
            $('#sort-lists').html(sortListsHtml.join(''))
        }

        $('#search-modal').modal({
            blurring: true,
            closable: false,
            transition: 'fade up',
        }).modal('show')
    })

    $('#search-button').on('click', () => {
        let query = $('#search-input').val()
        let sort = $('input[name="sort-options"]:checked').val()
        listStates.search = query || null
        listStates.sort = sort === 'updated_at' ? null : sort
        renderingPosts(1)
    })

    renderingPosts()
}