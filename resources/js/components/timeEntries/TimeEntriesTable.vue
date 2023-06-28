<script setup>
import TableWrapper from '@/components/tables/TableWrapper.vue'
import { useTimeEntryStore } from "@stores/TimeEntryStore/index.ts";
import { storeToRefs } from 'pinia'
import {onBeforeMount, ref} from "vue";
const timeEntryStore = useTimeEntryStore()


const { models: timeEntries, isFetched } = storeToRefs(timeEntryStore)

const isError = ref(false)

onBeforeMount(() => {
	if(!isFetched.value)
		timeEntryStore.fetch()
			.then(response => {
				isError.value = !response
			})
})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-3 Time Entries

table-wrapper(
	:is-loading="!isFetched"
	:is-error="isError"
	:columns="4"
)
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Started at

			th.px-6.py-3(scope="col") Ended at

			th.px-6.py-3(scope="col") Duration

	template(#table-body)
		tr(
			v-for="timeEntry in timeEntries"
			class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
		)
			td.px-6.py-4(scope="col") {{ timeEntry.title }}

			td.px-6.py-4(scope="col") {{ timeEntry.started_at }}

			td.px-6.py-4(scope="col") {{ timeEntry.ended_at }}

			td.px-6.py-4(scope="col") {{ timeEntry.duration }}

</template>
