import {defineStore} from "pinia";
import api from "../../utils/api";
import {ref} from "vue";

export const useImportStore = defineStore('importStore', () => {
	const isImporting = ref<boolean>(false)
	const importFailed = ref<boolean>(false)

	const importData = async () => {
		try {
			isImporting.value = true

			await api.post('import', {})
				.then(({data}) => {
					if(data !== true)
						new Error('Import start failed.')

				}).catch(error => {
					throw error.message
				})
		} catch (error) {
			importFailed.value = true
		}
	}

	return {
		isImporting,
		importFailed,

		importData,
	}
})
