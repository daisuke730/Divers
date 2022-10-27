function distanceBeautify(distance) {
    if (distance < 1000) {
        return distance + 'm'
    } else {
        return (distance / 1000).toFixed(1) + 'km'
    }
}

function durationBeautify(duration) {
    let hours = Math.floor(duration / 3600)
    let minutes = Math.floor((duration - hours * 3600) / 60)
    let seconds = duration - hours * 3600 - minutes * 60

    if (hours > 0) {
        return hours + '時間 ' + minutes + '分'
    } else if (minutes > 0) {
        return (minutes + Math.round(seconds / 60)) + '分'
    } else {
        return '1分未満'
    }
}