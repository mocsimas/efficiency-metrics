<script setup>
import {onBeforeMount} from "vue";

const workspaces = []

onBeforeMount(() => {

})

</script>

<template lang="pug">
table.table.table-hover
	thead
		tr
			th(scope="col") Title

			th(scope="col") Tracker

	tbody
		tr(v-for="workspace in workspaces")
			td(scope="col") {{ workspace.title }}

			td(scope="col") {{ workspace.tracker }}

</template>
