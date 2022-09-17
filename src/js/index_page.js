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
        <div id="like-button-%ROUTE_ID%">
    </div>
</div>`

const LIKE_BUTTON_TEMPLATE = `
<div class="ui labeled button" tabindex="0" onclick="%LIKE_STATE_TOGGLE%">
    <div class="ui %LIKE_COLOR% button"><i class="heart icon"></i>いいね</div>
    <a class="ui basic %LIKE_COLOR% left pointing label">%LIKE_COUNT%</a>
</div>
`

async function renderingPosts(page = 1) {
    // APIから投稿を取得
    let posts = await api('GET', {q: 'getPosts', page}).then(res => res.json())
    let postsHtmlArray = posts.map(post => {
        return CARD_TEMPLATE.replace(/%ROUTE_NAME%/g, post.todo).replace(/%ROUTE_ID%/g, post.id).replace(/%ROUTE_CREATED_AT%/g, post.created_at).replace(/%ROUTE_DESCRIPTION%/g, 'ここに説明文が入ります')
    })

    // htmlとして追加
    $('#route-list').html(postsHtmlArray.join(''))

    // いいねボタンを追加
    posts.forEach(async post => {
        let currentLikeState = await api('GET', {q: 'getPostLikes', post_id: post.id}).then(res => res.json())
        setLikeState(post.id, currentLikeState.isLiked, currentLikeState.likes, true)
    })
}

function setLikeState(id, state, count, isInit = false) {
    // いいね数を増減
    if (!isInit) state ? count++ : count--
    let likeButton = LIKE_BUTTON_TEMPLATE.replace(/%LIKE_STATE_TOGGLE%/g, `setLikeState(${id}, ${!state}, ${count})`).replace(/%LIKE_COLOR%/g, state ? 'red' : '').replace(/%LIKE_COUNT%/g, count)
    $(`#like-button-${id}`).html(likeButton)

    // APIを叩いてデータベースに反映
    api('POST', { q: state ? 'likePost' : 'unlikePost', post_id: id})
}

window.onload = () => {
    renderingPosts()
}