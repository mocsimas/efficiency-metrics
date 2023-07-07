<script setup>
import WorkspacesDurations from "@/components/metrics/workspace/WorkspacesDurations.vue";
import ImportButton from "@/components/button/import/ImportButton.vue";
import { useImportStore } from "@stores/ImportStore"
import {storeToRefs} from "pinia";

const importStore = useImportStore()

const { isImporting, importFailed } = storeToRefs(importStore)

const { importData } = importStore

</script>

<template lang="pug">
.flex.justify-end
	import-button(
		:isImporting="isImporting"
		:importFailed="importFailed"
		@click="importData()"
	)

workspaces-durations

</template>
