window.state = {}

const url = new URL(location)
const urlSearchParams = url.searchParams

urlSearchParams.forEach((value, key) => {
    window.state[key] = value
})

function getState(prop) {
    return window.state[prop] || null
}

function setState(prop, value) {
    window.state[prop] = value
    
    if (value === null) {
        urlSearchParams.delete(prop)
    } else {
        urlSearchParams.set(prop, value)
    }

    history.replaceState(null, null, url)
}