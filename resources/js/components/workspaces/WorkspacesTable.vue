<script setup>
import TableWrapper from '@/components/tables/TableWrapper.vue'
import {onBeforeMount} from "vue";

const workspaces = []

onBeforeMount(() => {

})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-3 Workspaces

table-wrapper
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Tracker

	template(#table-body)
		tr(
			v-for="workspace in workspaces"
			class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
		)
			td.px-6.py-4(scope="col") {{ workspace.title }}

			td.px-6.py-4(scope="col") {{ workspace.tracker }}

</template>
