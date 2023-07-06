<script setup lang="ts">
import WorkspacesMonthDurations from "@/components/metrics/workspace/WorkspacesMonthDurations.vue"
import { getPreviousMonth } from '@/utils/helpers'

</script>

<template lang="pug">
workspaces-month-durations(
	v-for="index in 3"
	:date="getPreviousMonth(index - 1)"
)

</template>
