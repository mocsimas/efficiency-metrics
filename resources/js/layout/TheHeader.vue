<template lang="pug">
header.mb-5
	nav(class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8")
		div(class="flex lg:flex-1")
			router-link(
				class="-m-1.5 p-1.5"
				:to="{name: 'dashboard'}"
			)
				| Efficiency metrics

		div(class="hidden lg:flex lg:gap-x-12")
			router-link(
				class="text-sm font-semibold leading-6 text-gray-900"
				:to="{name: 'dashboard'}"
			) Dashboard

			router-link(
				class="text-sm font-semibold leading-6 text-gray-900"
				:to="{name: 'time-entries'}"
			) Time Entries

		div(class="hidden lg:flex lg:flex-1 lg:justify-end")
</template>
