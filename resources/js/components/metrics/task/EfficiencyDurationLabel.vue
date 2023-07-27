<script setup lang="ts">
import {computed} from "vue";
import {storeToRefs} from "pinia";
import {useEstimateStore} from "@stores/EstimateStore";
import {durationToSeconds, secondsToDuration} from "../../../utils/helpers";

const estimateStore = useEstimateStore()
const { collection: estimates } = storeToRefs(estimateStore)

const props = defineProps({
	task: {
		type: Object,
		required: true,
	}
})

const estimate = computed(() => {
	return estimates.value.find((estimate) => estimate.task_uuid === props.task.uuid)
})

const estimateSeconds = computed(() => {
	const duration = estimate?.value?.duration

	if(!duration)
		return [0, 0]

	return [durationToSeconds(duration.from), durationToSeconds(duration.to)]
})

const taskSeconds = computed(() => {
	return durationToSeconds(props.task?.duration || 0)
})

const efficiency = computed(() => [estimateSeconds.value[0] - taskSeconds.value, estimateSeconds.value[1] - taskSeconds.value])

const getClasses = (efficiency: number): object => {
	return {'text-red-500': efficiency < 0, 'text-green-500': 0 < efficiency}
}

</script>

<template lang="pug">
template(v-if="estimate")
		template(v-if="efficiency[0] !== efficiency[1]")
			span(:class="getClasses(efficiency[0])")
				| {{ secondsToDuration(efficiency[0]) }}
				|
				| -
				|

		span(:class="getClasses(efficiency[1])")
			| {{ secondsToDuration(efficiency[1]) }}

span(v-else) -

</template>
