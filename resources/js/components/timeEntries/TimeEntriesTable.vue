<script setup lang="ts">
import TableWrapper from '@/components/tables/TableWrapper.vue'
import { useTimeEntryStore } from "@stores/TimeEntryStore/index.ts";
import { storeToRefs } from 'pinia'
import { onBeforeMount } from "vue";

const timeEntryStore = useTimeEntryStore()

const { collection: timeEntries, isFetched, fetchFailed: isError } = storeToRefs(timeEntryStore)

onBeforeMount(() => {
	if(!isFetched.value)
		timeEntryStore.fetch()
})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-3 Time Entries

table-wrapper(
	:is-loading="!isFetched"
	:is-error="isError"
	:columns="5"
)
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Started at

			th.px-6.py-3(scope="col") Ended at

			th.px-6.py-3(scope="col") Workspace

			th.px-6.py-3(scope="col") Duration

	template(#table-body)
		template(
			v-for="(timeEntry, index) in timeEntries"
			:key="index"
		)
			tr(
				v-if="!index || timeEntry.date !== timeEntries[index - 1].date"
				class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
			)
				td.px-6.py-4.text-right.font-bold(
					scope="col"
					colspan="4"
				)

				td.px-6.py-4.font-bold(scope="col") {{ timeEntry.date }}

			tr(
				class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
			)
				td.px-6.py-4(scope="col") {{ timeEntry.title }}

				td.px-6.py-4(scope="col") {{ timeEntry.started_at }}

				td.px-6.py-4(scope="col") {{ timeEntry.ended_at }}

				td.px-6.py-4(scope="col") {{ timeEntry.workspace.title }}

				td.px-6.py-4(scope="col") {{ timeEntry.duration }}

</template>
