const endpoint = '/api/action.php'

async function api(method, action, params = {}, errorHandling = true) {
    params['q'] = action

    switch(method) {
        case 'GET': {
            let querys = []
            for (let key in params) {
                querys.push(`${key}=${params[key]}`)
            }

            let urlWithQuery = `${endpoint}?${querys.join('&')}`
            return await responseHandler(fetch(urlWithQuery), errorHandling)
        }

        case 'POST': {
            let formData = new FormData()
            for (let key in params) {
                formData.append(key, params[key])
            }

            return await responseHandler(fetch(endpoint, {
                method: 'POST',
                body: formData
            }), errorHandling)
        }

        default: {
            throw new Error('Invalid method')
        }
    }
}

async function responseHandler(response, errorHandling) {
    try {
        let res = await response
        let json = await res.json()
        if (json.error && errorHandling) throw new Error(json.error)
        return json
    } catch (e) {
        throw new Error(e)
    }
}