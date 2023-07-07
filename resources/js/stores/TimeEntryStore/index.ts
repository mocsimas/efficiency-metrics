import {defineStore} from "pinia";
import {useBaseStore} from "../BaseStore";

export const useTimeEntryStore = defineStore('timeEntryStore', () => {
	const baseStore = useBaseStore()

	return {
		...baseStore,
		fetch: () => baseStore.fetch('time-entries'),
	}
})
