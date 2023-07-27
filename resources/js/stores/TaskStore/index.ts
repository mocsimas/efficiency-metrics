import {defineStore} from "pinia";
import {useBaseStore} from "../BaseStore";

export const useTaskStore = defineStore('taskStore', () => {
	const baseStore = useBaseStore()

	return {
		...baseStore,
		fetch: () => baseStore.fetch('tasks'),
	}
})
