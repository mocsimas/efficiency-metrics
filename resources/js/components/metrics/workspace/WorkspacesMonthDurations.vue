<script setup lang="ts">
import TableWrapper from "@/components/tables/TableWrapper.vue";
import {useWorkspaceStore} from "@stores/WorkspaceStore";
import {storeToRefs} from "pinia";
import {computed, onBeforeMount} from "vue";
import {secondsToDuration, sumDurations} from "@/utils/helpers";

const props = defineProps<{
	date: moment.Moment,
}>()

const workspacesStore = useWorkspaceStore()

const { collection: workspaces, isFetched, fetchFailed: isError } = storeToRefs(workspacesStore)

onBeforeMount(() => {
	if(!isFetched.value)
		workspacesStore.fetch()
})

const workspacesDurations = computed<string>(() => {
	const durations = workspaces.value.map(({durations}) => durations[props.date.format('YYYY-MM')])

	const seconds: number = sumDurations(durations)

	return secondsToDuration(seconds)
})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-4 Workspaces durations {{ date.format('YYYY MMMM') }}

table-wrapper.mb-14(
	:is-loading="!isFetched"
	:is-error="isError"
	:columns="2"
)
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Duration

	template(#table-body)
		tr(
			v-for="workspace in workspaces"
			class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
		)
			td.px-6.py-4(scope="col")
				| {{ workspace.title }}

			td.px-6.py-4(scope="col")
				| {{ workspace.durations[date.format('YYYY-MM')] || '-' }}

		tr(class="bg-white border-b dark:bg-gray-800 dark:border-gray-700")
			td.font-bold.px-6.py-4.text-right(scope="col")
				| Total for {{ date.format('YYYY MMMM') }}:

			td.font-bold.px-6.py-4(scope="col")
				| {{ workspacesDurations }}

</template>
