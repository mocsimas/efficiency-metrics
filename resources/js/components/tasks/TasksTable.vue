<script setup lang="ts">
import TableWrapper from '@/components/tables/TableWrapper.vue'
import { useTaskStore } from "@stores/TaskStore/index.ts";
import { storeToRefs } from 'pinia'
import { onBeforeMount } from "vue";

const taskStore = useTaskStore()

const { collection: tasks, isFetched, fetchFailed: isError } = storeToRefs(taskStore)

onBeforeMount(() => {
	if(!isFetched.value)
		taskStore.fetch()
})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-3 Tasks

table-wrapper(
	:is-loading="!isFetched"
	:is-error="isError"
	:columns="4"
)
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Project

			th.px-6.py-3(scope="col") Current

			th.px-6.py-3(scope="col") Estimate

	template(#table-body)
			tr(
				v-for="(task, index) in tasks"
				:key="index"
				class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
			)
				td.px-6.py-4(scope="col") {{ task.title }}

				td.px-6.py-4(scope="col") {{ task.project.title }}

				td.px-6.py-4(scope="col") {{ task.durations.current }}

				td.px-6.py-4(scope="col") {{ task.durations.estimate ?? '-' }}

</template>
