import {defineStore} from "pinia";
import {useBaseStore} from "../BaseStore";

export const useWorkspaceStore = defineStore('workspaceStore', () => {
	const baseStore = useBaseStore()

	return {
		...baseStore,
		fetch: () => baseStore.fetch('workspaces'),
	}
})
