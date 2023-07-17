<script setup lang="ts">
import TableWrapper from '@/components/tables/TableWrapper.vue'
import { useProjectStore } from "@stores/ProjectStore/index.ts";
import { storeToRefs } from 'pinia'
import { onBeforeMount } from "vue";

const projectStore = useProjectStore()

const { collection: projects, isFetched, fetchFailed: isError } = storeToRefs(projectStore)

onBeforeMount(() => {
	if(!isFetched.value)
		projectStore.fetch()
})

</script>

<template lang="pug">
h6.text-lg.font-bold.mb-3 Projects

table-wrapper(
	:is-loading="!isFetched"
	:is-error="isError"
	:columns="2"
)
	template(#table-head)
		tr
			th.px-6.py-3(scope="col") Title

			th.px-6.py-3(scope="col") Workspace

	template(#table-body)
			tr(
				v-for="(project, index) in projects"
				:key="index"
				class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
			)
				td.px-6.py-4(scope="col")
					router-link.text-blue-400(:to="{name: 'project', params: {project: project.uuid}}")
						| {{ project.title }}

				td.px-6.py-4(scope="col") {{ project.workspace.title }}

</template>

