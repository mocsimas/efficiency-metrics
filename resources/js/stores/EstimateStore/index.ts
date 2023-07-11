import {defineStore} from "pinia";
import {useBaseStore} from "../BaseStore";

export const useEstimateStore = defineStore('estimateStore', () => {
	const baseStore = useBaseStore()

	return {
		...baseStore,
		fetch: () => baseStore.fetch('estimates'),
		create: (payload: object) => baseStore.create('/estimates/create', payload),
		update: (payload: object) => baseStore.update('/estimates/update', payload),
	}
})
