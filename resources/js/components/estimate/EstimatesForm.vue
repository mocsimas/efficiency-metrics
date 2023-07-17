<script setup lang="ts">
import {onBeforeMount, reactive, ref, watch, watchEffect} from "vue";
import {storeToRefs} from "pinia";
import { useErrorStore } from '@stores/ErrorStore'
import { useEstimateStore } from "@/stores/EstimateStore/index.js";
import FormWrapper from "../form/FormWrapper.vue";
import DurationInput from "../form/input/DurationInput.vue";

const emit = defineEmits(['close'])

const props = defineProps<{
	task: object,
}>()

const estimateStore = useEstimateStore()

const { collection: estimates, isFetched } = storeToRefs(estimateStore)

const errorStore = useErrorStore()
const { errors } = storeToRefs(errorStore)

const estimate = ref<null | object>(null)

const form = reactive<object>({
	uuid: null,
	task_uuid: props.task.uuid,
	from: null,
	to: null,
})

const findEstimate = () => {
	estimate.value = props.task ? estimates.value.find(estimate => estimate.task_uuid === props.task.uuid) : null
}

const submit = () => {
	if(form.uuid) {
		estimateStore.update(form)
		return
	}

	estimateStore.create(form)
}

watch(estimate, () => {
	form.uuid = estimate?.value?.uuid || null
	form.task_uuid = props.task.uuid
	form.from = estimate?.value?.from || null
	form.to = estimate?.value?.to || null
})

onBeforeMount(() => {
	if(!isFetched.value)
		estimateStore.fetch().then(() => findEstimate())
	else
		findEstimate()
})

</script>

<template lang="pug">
form-wrapper(
	heading="Add estimate"
	@close="emit('close')"
	@submit="submit()"
)
	template(#body)
		div
			label.text-white From
			duration-input.mt-1.text-white(
				v-model="form.from"
				:errors="errors?.from || []"
			)

		div
			label.text-white To
			duration-input.mt-1.text-white(
				v-model="form.to"
				:errors="errors?.to || []"
			)

		//div
		//  label.block.mb-2.text-sm.font-medium.text-gray-900(
		//		for='email' class='dark:text-white') Your email
		//  input#email.bg-gray-50.border.border-gray-300.text-gray-900.text-sm.rounded-lg.block.w-full(type='email' name='email' class='focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white' placeholder='name@company.com' required='')
		//div
		//  label.block.mb-2.text-sm.font-medium.text-gray-900(
		//		for='password' class='dark:text-white') Your password
		//  input#password.bg-gray-50.border.border-gray-300.text-gray-900.text-sm.rounded-lg.block.w-full(type='password' name='password' placeholder='••••••••' class='focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white' required='')

		button.w-full.text-white.bg-blue-700.font-medium.rounded-lg.text-sm.px-5.text-center(
			type='submit'
			class='hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
		)
			| Save

</template>
