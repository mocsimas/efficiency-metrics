<script setup>
const props = defineProps({
	isLoading: {
		type: Boolean,
		default: false,
	},

	isError: {
		type: Boolean,
		default: false,
	},

	columns: {
		type: Number,
		required: true,
	},
})

</script>

<template lang="pug">
table.w-full.text-sm.text-left.text-gray-500(class="dark:text-gray-400")
	thead(class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400")
		slot(name="table-head")

	tbody
		tr(v-if="props.isError")
			td(
				scope="col"
				:colspan="props.columns"
			)
				div(
					role="alert"
					class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
				)
					svg(
						aria-hidden="true"
						class="flex-shrink-0 inline w-5 h-5 mr-3"
						fill="currentColor"
						viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg"
					)
						path(
							fill-rule="evenodd"
							d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
							clip-rule="evenodd"
						)
					div An error encountered.

		template(v-else-if="props.isLoading")
			tr(v-for="rowIndex in 5")
				td.px-6.py-4(
					v-for="columnIndex in props.columns"
					scope="col"
				)
					.animate-pulse(role="status")
						div(class="w-full bg-gray-200 rounded-2xl dark:bg-gray-700 h-6")

		slot(
			v-else
			name="table-body"
		)

</template>
