import axios from "axios";

const api = axios.create({
	baseURL: `${import.meta.env.VITE_APP_DOMAIN}/api/`
})

export default {
	get(url) {
		return new Promise((resolve, reject) => {
			api.get(url).then(response => {
				resolve(response.data)
			}).catch(error => {
				reject(error.response.data)
			})
		})
	},
}
