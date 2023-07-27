<script setup lang="ts">
import TableWrapper from '@/components/tables/TableWrapper.vue'
import { useProjectStore } from "@stores/ProjectStore/index.ts";
import { storeToRefs } from 'pinia'
import {onBeforeMount, onBeforeUnmount, reactive, ref} from "vue";
import {useRoute} from "vue-router";
import PrimaryButton from "@/components/button/PrimaryButton.vue";
import EstimatesForm from "@/components/estimate/EstimatesForm.vue"
import {useEstimateStore} from "@stores/EstimateStore";
import EfficiencyDurationLabel from "@/components/metrics/task/EfficiencyDurationLabel.vue";

const route = useRoute()

const projectStore = useProjectStore()

const estimateStore = useEstimateStore()

const { collection: projectsCollection, isFetched: projectsFetched, tasksCollection, tasksFetched, tasksFetchFailed } = storeToRefs(projectStore)

const { collection: estimates, isFetched: estimatesFetched } = storeToRefs(estimateStore)

const showEstimatesForm = ref<boolean>(false)

const estimatesFormTask = ref<object>({})

const project = reactive<object>({})

const findProject = () => {
	project.value = projectsCollection.value.find(project => {
		return project.uuid === route.params.project
	})
}

const showForm = (task: object) => {
	showEstimatesForm.value = true

	estimatesFormTask.value = task
}

const getTaskEstimate = (task: object): object => {
	return estimates.value.find((estimate) => estimate.task_uuid === task.uuid)
}

const formatTaskEstimate = (task: object): string => {
	const estimate = getTaskEstimate(task)

	return formatEstimate(estimate)
}

const formatEstimate = (estimate: object): string => {
	if(!estimate)
		return '-'

	const durations = [estimate.duration.from, estimate.duration.to]

	if(durations[0] === durations[1])
		return durations[0]

	return `${durations[0]} - ${durations[1]}`
}

onBeforeMount(() => {
	if(!projectsFetched.value)
		projectStore.fetch().then(() => findProject())

	findProject()

	if(!tasksFetched.value)
		projectStore.fetchTasks(route.params.project)

	if(!estimatesFetched.value)
		estimateStore.fetch()
})

onBeforeUnmount(() => {
	projectStore.restoreTaskRefs()
})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-3 Tasks of {{ project.value?.title }}

table-wrapper(
	:is-loading="!tasksFetched"
	:is-error="tasksFetchFailed"
	:columns="6"
)
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Project

			th.px-6.py-3(scope="col") Current

			th.px-6.py-3(scope="col") Estimate

			th.px-6.py-3(scope="col") Difference

			th.px-6.py-3(scope="col")

	template(#table-body)
			tr(
				v-for="(task, index) in tasksCollection"
				:key="index"
				class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
			)
				td.px-6.py-4(scope="col") {{ task.title }}

				td.px-6.py-4(scope="col") {{ task.project.title }}

				td.px-6.py-4(scope="col") {{ task.duration }}

				td.px-6.py-4(scope="col") {{ formatTaskEstimate(task) }}

				td.px-6.py-4(scope="col")
					efficiency-duration-label(:task="task")

				td.px-6.py-4(scope="col")
					primary-button(@click="showForm(task)")
						| Add estimate

estimates-form(
	v-if="showEstimatesForm"
	:task="estimatesFormTask"
	@close="showEstimatesForm = false"
)

</template>
