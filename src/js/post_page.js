window.onload = async function() {
    $('#url-input').on('input', () => { parseURL() })
    $('#submit-button').on('click', () => { submit() })

    if (!modeCheck()) parseURL()
}

async function parseURL() {
    let url = $('#url-input').val()

    // もし短縮URLだった場合は展開する
    if (isShortURL(url)) {
        let params = { url: encodeURIComponent(getShortURL(url)) }
        let res = await api('GET', 'getOriginalUrl', params)

        if (res.url) {
            $('#url-input').val(decodeURIComponent(res.url))
            return parseURL()
        }
    }

    if (validateURL(url)) {
        let { startPointName, endPointName } = parseNameFromURL(url)
        $('#departure').val(startPointName)
        $('#destination').val(endPointName)
    }
}

function showError(message) {
    $('#error-message').text(message)
    $('#error-message').removeClass('hidden')
}

function hideError() {
    $('#error-message').addClass('hidden')
}

async function modeCheck() {
    const querys = new URLSearchParams(location.search)
    if (!querys.has('id')) return false

    const id = querys.get('id')
    const res = await api('GET', 'getPost', { id: id }, false)

    if (res.error) showError(res.error)

    $('#editor-title').text('投稿を編集')
    $('#submit-button').text('編集')

    $('#url-input').val(res.url)
    $('#departure').val(res.departure)
    $('#destination').val(res.destination)
    $('#description').val(res.description)
}

async function submit() {
    const querys = new URLSearchParams(location.search)
    let id = querys.get('id') ?? -1
    const url = $('#url-input').val()
    const departure = $('#departure').val()
    const destination = $('#destination').val()
    const description = $('#description').val()

    if (!url) return showError('URLを入力してください')
    if (!departure || !destination) return showError('出発地と目的地を入力してください')

    let params = {
        id: id,
        url: url,
        departure: departure,
        destination: destination,
        description: description ?? ''
    }

    let res = await api('POST', 'postRoute', params, false)

    if (res.error) {
        showError(res.error)
    } else {
        location.href = `./`
    }
}