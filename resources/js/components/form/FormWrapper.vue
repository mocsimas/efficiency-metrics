<script setup lang="ts">
import {onBeforeUnmount} from "vue";
import { useErrorStore } from '@stores/ErrorStore'

const errorStore = useErrorStore()

const emit = defineEmits(['close', 'submit'])

const props = defineProps<{
	heading: string,
}>()

onBeforeUnmount(() => {
	errorStore.clearErrors()
})

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
				@click="emit('close')"
			)
				svg.w-4.h-4(
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
				slot(name="title")
					h3.mb-4.text-xl.font-medium.text-gray-900(class='dark:text-white') {{ heading }}

				form.space-y-6(
					action='#'
					@submit.prevent="emit('submit')"
				)
					slot(name="body")
</template>
