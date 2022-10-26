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
    let existWaypoints = Math.max(destinationIndex - 1, 0)
    let waypointsArr = []
    for (let i = 1; i <= existWaypoints; i++) {
        waypointsArr.push(decodeURIComponent(arr[i]))
    }

    return {
        startPointName: getDestName(arr[0]),
        endPointName: getDestName(arr[Math.max(destinationIndex, 1)]),
        waypoints: waypointsArr,
        rawStartPointName: decodeURIComponent(arr[0]),
        rawEndPointName: decodeURIComponent(arr[Math.max(destinationIndex, 1)]),
    }
}

function parseWaypointsFromURL(url) {
    let arr = url.replace(GOOGLE_MAP_URL_REGEX, '').split('/')
    let dataIndex = arr.findIndex((element) => element.startsWith('data='))
    let datas = arr[dataIndex].replace('data=', '').split('!')
    let waypoints = []
    for (let i = 0; i < datas.length; i++) {
        if (datas[i] !== '1m2') continue
        waypoints.push(`${datas[i + 2].replace(/[0-9]d/, '')},${datas[i + 1].replace(/[0-9]d/, '') }`)
    }

    return waypoints
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