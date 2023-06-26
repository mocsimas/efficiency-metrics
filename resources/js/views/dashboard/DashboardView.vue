<script setup>
import {defineAsyncComponent} from "vue"

const workspacesTable = defineAsyncComponent({
	loader: () => import('@/components/workspaces/WorkspacesTable.vue'),
})
</script>

<template lang="pug">
workspaces-table

</template>
