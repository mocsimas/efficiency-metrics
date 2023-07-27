import {defineStore} from "pinia";
import {useBaseStore} from "../BaseStore";
import {ref} from "vue";
import api from "../../utils/api";

export const useProjectStore = defineStore('projectStore', () => {
	const baseStore = useBaseStore()

	const tasksFetched = ref<boolean>(false)
	const tasksFetchFailed = ref<boolean>(false)
	const tasksCollection = ref([])

	const restoreTaskRefs = () => {
		tasksFetched.value = false
		tasksFetchFailed.value = false
		tasksCollection.value = []
	}

	const fetchTasks = async (uuid: string) => {
		restoreTaskRefs()

		try {
			await api.get(`/projects/${uuid}/tasks`)
				.then(({data}) => {
					tasksFetched.value = true
					tasksCollection.value = data
				}).catch(error => {
					throw error.message
				})
		} catch (error) {
			tasksFetchFailed.value = true
		}
	}

	return {
		...baseStore,
		tasksFetched,
		tasksFetchFailed,
		tasksCollection,

		fetch: () => baseStore.fetch('projects'),
		restoreTaskRefs,
		fetchTasks,
	}
})
