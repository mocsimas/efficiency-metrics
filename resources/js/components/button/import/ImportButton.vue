<script setup lang="ts">
import PrimaryButton from "@/components/button/PrimaryButton.vue";
import LoadingIcon from "../../icon/LoadingIcon.vue";
import AlertDangerIcon from "../../icon/alert/AlertDangerIcon.vue";

const props = defineProps<{
	isImporting: boolean,
	importFailed: boolean,
}>()

</script>

<template lang="pug">
primary-button.flex.items-end(
	:disabled="isImporting"
)
	alert-danger-icon.mr-2(v-if="importFailed")

	template(v-if="isImporting")
		| Importing
		loading-icon.ml-2.pb-1(:color="'#FFF'")

	template(v-else)
		| Import

</template>
