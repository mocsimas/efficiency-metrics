import {defineStore} from "pinia";
import {ref} from "vue";
import {ErrorsArrayInterface} from "@/types/error/ErrorsArrayInterface"

export const useErrorStore = defineStore('errorStore', () => {
	const errors = ref({})

	const setErrors = (errorsObject: ErrorsArrayInterface): void => {
		errors.value = errorsObject
	}

	const clearErrors = (): void => {
		setErrors({})
	}

	return {
		errors,

		setErrors,
		clearErrors,
	}
})
