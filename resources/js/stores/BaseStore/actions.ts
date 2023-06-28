import api from '@/utils/api.ts'

export default {
	async fetch(url) {
		try {
			await api.get('time-entries/')
				.then(({data}) => {
					this.isFetched = true
					this.models = data
				}).catch(error => {
					throw error.message
				})
		} catch (error) {
			return false
		}

		return true
	},
}
