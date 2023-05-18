<template>
    <div :class="$attrs.class">
		<label v-if="label" class="form-label block text-sm font-black leading-5 text-gray-700" :for="id">{{ label }}</label>
		<input :id="id" ref="input" v-bind="{ ...$attrs, class: null }" class="mt-1 flex-1 form-input border-cool-gray-100 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-lg" 
			:class="[error ? ' @apply border-red-500' : ''] " :type="type" 
			:value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
		<div v-if="error" class="mt-1 text-red-500 text-sm">{{ error }}</div>
    </div>
</template>

<script>
export default {
	props: {
		id: {
			type: String,
			default() {
				return `select-input-${Math.random() * 1000}`;
			},
		},
		type: {
			type: String,
			default: 'text',
		},
		modelValue: String|Number,
		label: String,
		error: String,
	},
	methods: {
		focus() {
			this.$refs.input.focus()
		},
		select() {
			this.$refs.input.select()
		},
		setSelectionRange(start, end) {
			this.$refs.input.setSelectionRange(start, end)
		},
	},
}
</script>
