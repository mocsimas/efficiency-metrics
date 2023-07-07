import axios, {CreateAxiosDefaults} from "axios";

const api = axios.create<CreateAxiosDefaults | undefined>({
	baseURL: `${import.meta.env.VITE_APP_DOMAIN}/api/`
})

export default {
	get(url: string) {
		return new Promise((resolve, reject) => {
			api.get(url).then(({data}) => {
				resolve(data)
			}).catch(({response}) => {
				reject(response.data)
			})
		})
	},

	post(url: string, data: object, config: object = {}) {
		return new Promise((resolve, reject) => {
			api.post(url, data, config)
				.then(({data}) => {
					resolve(data)
				})
				.catch(({response}) => {
					reject(response.data)
				})
		})
	},
}
