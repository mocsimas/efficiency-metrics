<script setup lang="ts">
import DurationInput from "../form/input/DurationInput.vue";
import { useEstimateStore } from "@/stores/EstimateStore/index.js";
import {onBeforeMount, reactive, ref, watch} from "vue";
import {storeToRefs} from "pinia";

const emit = defineEmits(['close'])

const props = defineProps<{
	task: object,
}>()

const estimateStore = useEstimateStore()

const { collection: estimates, isFetched } = storeToRefs(estimateStore)

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
	form.from = estimate?.value?.from ?? null
	form.to = estimate?.value?.to ?? null
})

onBeforeMount(() => {
	if(!isFetched.value)
		estimateStore.fetch().then(() => findEstimate())
	else
		findEstimate()
})

const close = () => {
	emit('close')
}

</script>

<template lang="pug">
.backdrop-blur-sm.fixed.top-0.left-0.right-0.z-50.w-full.p-4.overflow-x-hidden.overflow-y-auto.max-h-full.flex.items-center.justify-center(
	tabindex='-1'
	aria-hidden='true'
	class='md:inset-0'
)
	.relative.w-full.max-w-md.max-h-full
		.relative.bg-white.rounded-lg.shadow(class='dark:bg-gray-700')
			button.absolute.top-3.text-gray-400.bg-transparent.rounded-lg.text-sm.w-8.h-8.ml-auto.inline-flex.justify-center.items-center(
				type='button'
				class='right-2.5 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white'
				@click="close()"
			)
				svg.w-3.h-3(
					aria-hidden='true'
					xmlns='http://www.w3.org/2000/svg'
					fill='none'
					viewbox='0 0 14 14'
				)
					path(
						stroke='currentColor'
						stroke-linecap='round'
						stroke-linejoin='round'
						stroke-width='2'
						d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'
					)
				span.sr-only Close modal

			.px-6.py-6(class='lg:px-8')
				h3.mb-4.text-xl.font-medium.text-gray-900(class='dark:text-white') Add estimate
				form.space-y-6(
					action='#'
					@submit.prevent="submit()"
				)
					div
						label.text-white From
						duration-input.mt-1.text-white(v-model="form.from")

					div
						label.text-white To
						duration-input.mt-1.text-white(v-model="form.to")
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
