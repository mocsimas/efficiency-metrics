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

	return {
		isFetched,
		fetchFailed,
		collection,

		fetch,
	}
}
