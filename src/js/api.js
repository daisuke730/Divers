const endpoint = '/api/action.php'

async function api(method, json) {
    switch(method) {
        case 'GET': {
            let querys = []
            for (let key in json) {
                querys.push(`${key}=${json[key]}`)
            }

            let urlWithQuery = `${endpoint}?${querys.join('&')}`
            return await fetch(urlWithQuery)
        }

        case 'POST': {
            let formData = new FormData()
            for (let key in json) {
                formData.append(key, json[key])
            }

            return await fetch(endpoint, {
                method: 'POST',
                body: formData
            })
        }

        default: {
            throw new Error('Invalid method')
        }
    }
}