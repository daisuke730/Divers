const endpoint = '/api/action.php'

async function api(method, action, params) {
    params['q'] = action

    switch(method) {
        case 'GET': {
            let querys = []
            for (let key in params) {
                querys.push(`${key}=${params[key]}`)
            }

            let urlWithQuery = `${endpoint}?${querys.join('&')}`
            return await fetch(urlWithQuery)
        }

        case 'POST': {
            let formData = new FormData()
            for (let key in params) {
                formData.append(key, params[key])
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