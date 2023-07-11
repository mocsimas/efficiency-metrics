import {ref} from "vue";
import api from "../../utils/api";

export function useBaseStore() {
	const isFetched = ref<boolean>(false)
	const fetchFailed = ref<boolean>(false)
	const collection = ref([])

	const fetch = async (url: string) => {
		try {
			await api.get(url)
				.then(({data}) => {
					isFetched.value = true
					collection.value = data
				}).catch(error => {
					throw error.message
				})
		} catch (error) {
			fetchFailed.value = true
		}
	}

	const create = async (url: string, payload: object) => {
		let isSuccess = true

		try {
			await api.post(url, payload)
				.then(({data, status}) => {

					if(status !== 'success')
						new Error('Failed to create.')

					collection.value.unshift(data)

				}).catch(error => {
					throw error.message
				})
		} catch (error) {
			isSuccess = false
		}

		return isSuccess
	}

	const update = async (url: string, payload: object) => {
		let isSuccess = true

		try {
			await api.post(url, payload)
				.then(({data, status}) => {
					if(status !== 'success')
						new Error('Failed to update.')

					const index = collection.value.findIndex(model => model.uuid === data.uuid)

					if(0 <= index)
						collection.value[index] = data

				}).catch(error => {
					throw error.message
				})
		} catch (error) {
			isSuccess = false
		}

		return isSuccess
	}

	return {
		isFetched,
		fetchFailed,
		collection,

		fetch,
		create,
		update,
	}
}
