const CARD_TEMPLATE = `
<div class="card">
    <div class="content">
        <div class="header">
            <a href="detail.php?id=%ROUTE_ID%">%ROUTE_NAME%</a>
        </div>
        <div class="meta">
            <span><i class="walking icon"></i> %ROUTE_DISTANCE%</span>
            <span><i class="clock icon"></i> %ROUTE_DURATION%</span>
            <span><i class="calendar icon"></i> %ROUTE_CREATED_AT%</span>
        </div>
        <div class="image">
            <a href="detail.php?id=%ROUTE_ID%"><img src="%THUMBNAIL_URL%"></a>
        </div>
        <div class="description">%ROUTE_DESCRIPTION%</div>
    </div>
    <div class="extra content">
        <div id="like-button-%ROUTE_ID%">%BUTTON_COMPONENT%</div>
        %MANAGE_COMPONENT%
    </div>
</div>`

const LIKE_BUTTON_BIG_TEMPLATE = `
<div class="ui labeled button" tabindex="0" onclick="%LIKE_STATE_TOGGLE%">
    <div class="ui %LIKE_COLOR% button"><i class="heart icon"></i>いいね</div>
    <a class="ui basic %LIKE_COLOR% left pointing label">%LIKE_COUNT%</a>
</div>
`

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

const PAGINATION_TEMPLATE = `
<a class="item %CLASS%" onclick="%ACTION%">%NUMBER%</a>
`

const TABLE_TEMPLATE = `
<tr>
    <td>%ROUTE_ID%</td>
    <td><a href="%DETAIL_URL%">%ROUTE_NAME%</a></td>
    <td><a href="%ROUTE_URL%">リンク</a></td>
    <td>%ROUTE_UPDATED_AT%</td>
    <td>%USER_ID%</td>
    <td class="right aligned">
        <button class="ui button" onclick="%EDIT_ACTION%">編集</button>
        <button class="ui button" onclick="%DELETE_ACTION%">削除</button>
    </td>
</tr>
`

isLoggedIn = false
api('GET', 'isLoggedIn').then(res => {
    isLoggedIn = res.isLoggedIn
})

function noLoginError() {
    $.toast({
        class: 'warning',
        title: `「いいね」をするにはログインしてください`,
        displayTime: 5000,
        position: 'bottom attached',
        newestOnTop: true
    })
}

function setLikeState(id, state, count, isStatic, useBigButton) {
    // いいね数を増減
    state ? count++ : count--

    let likeButton = getLikeButtonTemplate(id, state, count, isStatic, useBigButton)
    $(isStatic ? '#like-button' : `#like-button-${id}`).html(likeButton)

    // APIを叩いてデータベースに反映
    api('POST', state ? 'likePost' : 'unlikePost', { post_id: id })
}

function getLikeButtonTemplate(id, state, count, isStatic = false, useBigButton = false) {
    return (useBigButton ? LIKE_BUTTON_BIG_TEMPLATE : LIKE_BUTTON_TEMPLATE)
        .replace(/%LIKE_STATE_TOGGLE%/g, isLoggedIn ? `setLikeState(${id}, ${!state}, ${count}, ${isStatic}, ${useBigButton})` : 'noLoginError()')
        .replace(/%LIKE_COLOR%/g, state ? 'red' : '')
        .replace(/%LIKE_COUNT%/g, count)
}

function getManageComponentTemplate(id) {
    return MANAGE_COMPONENT_TEMPLATE
        .replace(/%EDIT_ACTION%/g, `location.href = 'editor.php?id=${id}'`)
        .replace(/%DELETE_ACTION%/g, `showDeleteModal(${id})`)
}

function getPaginationButton(page, cssClass, text, search) {
    return PAGINATION_TEMPLATE
        .replace(/%CLASS%/g, cssClass)
        .replace(/%ACTION%/g, (cssClass === 'disabled' || cssClass === 'active') ? '' : `renderingPosts(${page + (search ? `, '${search}'` : '')})`)
        .replace(/%NUMBER%/g, text || page)
}

function getPaginationTemplate(page, count, search) {
    let maxPage = Math.ceil(count / 10)
    let paginationHtmlArray = []

    if (maxPage >= 1) {
        paginationHtmlArray.push(getPaginationButton(1, page === 1 ? 'disabled' : '', '<i class="angle double left icon"></i>', search))
        paginationHtmlArray.push(getPaginationButton(Math.max(page - 1, 1), page === 1 ? 'disabled' : '', '<i class="angle left icon"></i>', search))

        for (let i = 1; i <= maxPage; i++) {
            paginationHtmlArray.push(getPaginationButton(i, i === page ? 'active' : '', null, search))
        }

        paginationHtmlArray.push(getPaginationButton(Math.min(page + 1, maxPage), page === maxPage ? 'disabled' : '', '<i class="angle right icon"></i>', search))
        paginationHtmlArray.push(getPaginationButton(maxPage, page === maxPage ? 'disabled' : '', '<i class="angle double right icon"></i>', search))
    }

    return paginationHtmlArray.join('')
}