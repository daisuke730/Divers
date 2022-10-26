const routeDataStatus = {
    mapLoaded: false,
    routeDataLoaded: false,
    isNewPost: null
}
const routeData = {}
const mapService = {}
const latestMapData = {
    res: null,
    url: null
}
const urlQuerys = new URLSearchParams(location.search)

window.onload = async function() {
    $('#url-input').on('change', () => { parseURL() })
    $('#submit-button').on('click', () => { submit() })
    $('#departure').on('change', () => { updateRoute() })
    $('#destination').on('change', () => { updateRoute() })
    $('#import-confirm-button').on('click', () => { applyURLRoute() })

    routeDataStatus.isNewPost = !urlQuerys.has('id')
    routeDataStatus.routeDataLoaded = true
    initMap()
}

window.mapReady = () => {
    routeDataStatus.mapLoaded = true
    initMap()
}

function initMap() {
    if (!routeDataStatus.mapLoaded || !routeDataStatus.routeDataLoaded) return

    const map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 33.60689,
            lng: 130.41784
        },
        zoom: 15,
        mapTypeControl: false,
        streetViewControl: false
    })

    const directionsService = new google.maps.DirectionsService()
    const directionsRenderer = new google.maps.DirectionsRenderer({
        draggable: true,
        map,
        panel: document.getElementById("panel"),
    })

    directionsRenderer.addListener('directions_changed', () => {
        const directions = directionsRenderer.getDirections()

        if (directions) {
            latestMapData.res = directions
            $('#route-duration').text(directions.routes[0].legs[0].duration.text)
            $('#route-distance').text(directions.routes[0].legs[0].distance.text)
        }
    })

    mapService.map = map
    mapService.directionsService = directionsService
    mapService.directionsRenderer = directionsRenderer

    if (!routeDataStatus.isNewPost) applyMode()
}

function displayRoute(origin, destination, waypoints = []) {
    mapService.directionsService.route({
        origin: origin,
        destination: destination,
        waypoints: waypoints,
        travelMode: google.maps.TravelMode.WALKING
    }).then((result) => {
        mapService.directionsRenderer.setDirections(result)
        hideInfo()
        hideError()
    }).catch((e) => {
        console.error('Error: ', e)
        latestMapData.res = null
        switch(e.code) {
            case 'NOT_FOUND': {
                showInfo('指定された出発地/目的地のルートが見つかりませんでした。<br>大まかな名称を入力していたのであれば、詳細な名称を入力してみてください。<br>例: 福岡市 → 福岡市中央区')
                break
            }

            default: {
                showError('ルートの取得に失敗しました。<br>時間を開けてから再度お試しください。<br>Err: ' + e.code)
            }
        }
    })
}

function updateRoute() {
    const departure = $('#departure').val()
    const destination = $('#destination').val()

    if (departure && destination) {
        displayRoute(departure, destination)
    }
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
        $('#url-status-message').text('正常にルートを読み込めました')
        latestMapData.url = url
    } else {
        $('#url-status-message').text('GoogleMapsのURLを入力してください。')
        latestMapData.url = null
    }
}

function applyURLRoute() {
    let url = latestMapData.url
    if (!url) return

    let URLroute = parseNameFromURL(url)
    let URLwaypoints = parseWaypointsFromURL(url)
    let waypoints = URLroute.waypoints.concat(URLwaypoints)

    $('#departure').val(URLroute.startPointName)
    $('#destination').val(URLroute.endPointName)

    displayRoute(URLroute.rawStartPointName, URLroute.rawEndPointName, waypoints.map((waypoint) => {
        return { location: waypoint, stopover: false }
    }))
}

function showError(message) {
    $('#error-message').html(message)
    $('#error-message').removeClass('hidden')
}

function hideError() {
    $('#error-message').addClass('hidden')
}

function showInfo(message) {
    $('#info-message').html(message)
    $('#info-message').removeClass('hidden')
}

function hideInfo() {
    $('#info-message').addClass('hidden')
}

async function applyMode() {
    const id = urlQuerys.get('id')
    const res = await api('GET', 'getPost', { id: id }, false)

    if (res.error) {
        showError(res.error)
        return false
    }

    Object.assign(routeData, res)

    $('#editor-title').text('投稿を編集')
    $('#submit-button').text('編集')
    $('#departure').val(res.departure)
    $('#destination').val(res.destination)
    $('#description').val(res.description)

    displayRoute(res.departure_location, res.destination_location, JSON.parse(res.waypoints).map((waypoint) => {
        return { location: waypoint, stopover: false }
    }))

    return true
}

async function submit() {
    const querys = new URLSearchParams(location.search)
    let id = querys.get('id') ?? -1
    const departure = $('#departure').val()
    const destination = $('#destination').val()
    const description = $('#description').val()

    if (!departure || !destination) return showError('出発地と目的地を入力してください')
    if (!latestMapData.res) return showError('マップのルート情報を読み込めませんでした。再度お試しください。')
    hideError()

    const mapData = latestMapData.res.routes[0].legs[0]
    let params = {
        id: id,
        departure: departure,
        destination: destination,
        departure_location: mapData.start_location.lat() + ',' + mapData.start_location.lng(),
        destination_location: mapData.end_location.lat() + ',' + mapData.end_location.lng(),
        waypoints: JSON.stringify(mapData.via_waypoint.map((waypoint) => {
            return waypoint.location.lat() + ',' + waypoint.location.lng()
        })),
        description: description ?? ''
    }

    let res = await api('POST', 'postRoute', params, false)

    if (res.error) {
        showError(res.error)
    } else {
        location.href = `./`
    }
}