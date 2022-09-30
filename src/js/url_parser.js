const GOOGLE_MAP_URL_REGEX = /^https:\/\/www.google\..*\/maps\/dir\//

function validateURL(url) {
    return url.match(GOOGLE_MAP_URL_REGEX)
}

function parseNameFromURL(url) {
    let arr = url.replace(GOOGLE_MAP_URL_REGEX, '').split('/')
    return {
        startPointName: getDestName(arr[0]),
        endPointName: getDestName(arr[1])
    }
}

function getDestName(str) {
    let target = decodeURIComponent(str)
    if (!target.match(/、|\+/)) return target;
    if (target.match('、')) {
        return target.split('、')[0]
    } else {
        let arr = target.split('+')
        arr.shift()
        return arr.join(' ')
    }
}