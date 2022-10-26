const GOOGLE_MAP_URL_REGEX = /^https:\/\/www.google\..*\/maps\/dir\//
const GOOGLE_SHORT_URL_REGEX = /https:\/\/(.+[^.]\.)?goo\.gl\/.*[^\s]+/

function isShortURL(url) {
    return !!url.match(GOOGLE_SHORT_URL_REGEX)
}

function getShortURL(url) {
    return url.match(GOOGLE_SHORT_URL_REGEX)[0]
}

function validateURL(url) {
    return url.match(GOOGLE_MAP_URL_REGEX)
}

function parseNameFromURL(url) {
    let arr = url.replace(GOOGLE_MAP_URL_REGEX, '').split('/')
    let destinationIndex = arr.findIndex((element) => /@([0-9.]+),([0-9.]+),([0-9.]+z)/.test(element)) - 1
    return {
        startPointName: getDestName(arr[0]),
        endPointName: getDestName(arr[Math.max(destinationIndex, 1)])
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