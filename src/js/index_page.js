const CARD_TEMPLATE = `
<div class="card">
    <div class="content">
        <div class="header">
            <a href="detail.php?id=%ROUTE_ID%">%ROUTE_NAME%</a>
        </div>
        <div class="meta">
            <span class="date">%ROUTE_CREATED_AT%</span>
        </div>
        <div class="description">%ROUTE_DESCRIPTION%</div>
    </div>
    <div class="extra content">
        <div id="like-button-%ROUTE_ID%">%BUTTON_COMPONENT%</div>
        %MANAGE_COMPONENT%
    </div>
</div>`

// const LIKE_BUTTON_TEMPLATE = `
// <div class="ui labeled button" tabindex="0" onclick="%LIKE_STATE_TOGGLE%">
//     <div class="ui %LIKE_COLOR% button"><i class="heart icon"></i>いいね</div>
//     <a class="ui basic %LIKE_COLOR% left pointing label">%LIKE_COUNT%</a>
// </div>
// `

const LIKE_BUTTON_TEMPLATE = `
<span class="left floated" onclick="%LIKE_STATE_TOGGLE%">
    <i class="heart %LIKE_COLOR% like icon"></i>
    <span class="ui %LIKE_COLOR%">%LIKE_COUNT% いいね</span>
</span>
`

const MANAGE_COMPONENT_TEMPLATE = `
<span class="right floated">
    <i class="edit icon" onclick="%EDIT_ACTION%"></i>
    <i class="trash icon" onclick="%DELETE_ACTION%"></i>
</span>
`

async function renderingPosts(page = 1, search) {
    // APIから投稿を取得

    let params = {page}
    if (search) params['search'] = search
    let posts = await api('GET', 'getPosts', params).then(res => res.json())
    let postsHtmlArray = posts.map(post => {
        return CARD_TEMPLATE
            .replace(/%ROUTE_NAME%/g, post.todo)
            .replace(/%ROUTE_ID%/g, post.id)
            .replace(/%ROUTE_CREATED_AT%/g, post.created_at)
            .replace(/%ROUTE_DESCRIPTION%/g, 'ここに説明文が入ります')
            .replace(/%BUTTON_COMPONENT%/g, getLikeButtonTemplate(post.id, post.is_liked, post.like_count))
            .replace(/%MANAGE_COMPONENT%/g, post.can_edit ? getManageComponentTemplate(post.id) : '')
    })

    // htmlとして追加
    $('#route-list').html(postsHtmlArray.join(''))
}

function setLikeState(id, state, count) {
    // いいね数を増減
    state ? count++ : count--

    let likeButton = getLikeButtonTemplate(id, state, count)
    $(`#like-button-${id}`).html(likeButton)

    // APIを叩いてデータベースに反映
    api('POST', state ? 'likePost' : 'unlikePost', {post_id: id})
}

function getLikeButtonTemplate(id, state, count) {
    return LIKE_BUTTON_TEMPLATE
        .replace(/%LIKE_STATE_TOGGLE%/g, `setLikeState(${id}, ${!state}, ${count})`)
        .replace(/%LIKE_COLOR%/g, state ? 'red' : '')
        .replace(/%LIKE_COUNT%/g, count)
}

function getManageComponentTemplate(id) {
    return MANAGE_COMPONENT_TEMPLATE
        .replace(/%EDIT_ACTION%/g, `location.href = 'editor.php?id=${id}'`)
        .replace(/%DELETE_ACTION%/g, `showDeleteModal(${id})`)
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