<script setup lang="ts">
const props = defineProps({
	type: {
		type: String,
		default: 'button',
		validator: (title) => ['button', 'submit'].includes(title),
	},

	disabled: {
		type: Boolean,
		default: false,
	}
})

</script>

<template lang="pug">
button.bg-blue-500.text-white.font-bold.py-2.px-4.rounded(
	:type="type"
	:disabled="disabled"
	:class="[disabled ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700']"
)
	slot

</template>
