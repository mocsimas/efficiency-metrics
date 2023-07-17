import axios from './api/axios'
import { useErrorStore } from '@stores/ErrorStore'
import { ErrorsArrayInterface } from "@/types/error/ErrorsArrayInterface"

export default {
	get(url: string) {
		return new Promise((resolve, reject) => {
			axios.get(url).then(({data}) => {
				resolve(data)
			}).catch(({response}) => {
				this.handleErrors(response.status, response.data.errors)

				reject(response.data)
			})
		})
	},

	post(url: string, data: object, config: object = {}) {
		return new Promise((resolve, reject) => {
			axios.post(url, data, config)
				.then(({data}) => {
					resolve(data)
				})
				.catch(({response}) => {
					this.handleErrors(response.status, response.data.errors)

					reject(response.data)
				})
		})
	},

	handleErrors(status, errors: ErrorsArrayInterface = {}) {
		switch(status) {
			case 422:
				useErrorStore().setErrors(errors)
				break
		}
	},
}
