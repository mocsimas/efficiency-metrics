<script setup lang="ts">
import {ref, watch, watchEffect} from "vue";

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const hours = ref<number>(0)
const minutes = ref<number>(0)
const seconds = ref<number>(0)

watch(() => props.modelValue, () => {
	const duration = parseInt(props.modelValue || 0)

	hours.value = Math.floor(duration / 3600)
	minutes.value = Math.floor((duration % 3600) / 60)
	seconds.value = duration % 60
})

watchEffect(() => {
	const duration = hours.value * 60 * 60 + minutes.value * 60 + seconds.value

	emit('update:modelValue', duration)
})

</script>

<template lang="pug">
div.flex
	span.text-white {{ hours }}
	input.text-black(type="number" v-model="hours" class="w-20 mr-2")
	span h

	span.text-white {{ minutes }}
	input.text-black(type="number" v-model="minutes" class="w-20 ml-2")
	span min

	span.text-white {{ seconds }}
	input.text-black(type="number" v-model="seconds" class="w-20 ml-2")
	span s

</template>
