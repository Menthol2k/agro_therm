<template>
    <div :class="$attrs.class">
        <label v-if="label" class="form-label block text-sm font-black leading-5 text-gray-700" :for="id">{{ label }}</label>
        <select :id="id" ref="input" v-model="selected" v-bind="{ ...$attrs, class: null }" class="mt-1 w-full form-select border-cool-gray-100 block transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-lg" :class="{ error: error }">
            <slot />
        </select>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
import { v4 as uuid } from 'uuid'

export default {
    inheritAttrs: false,
    props: {
        id: {
        type: String,
        default() {
            return `select-input-${uuid()}`
        },
        },
        error: String,
        label: String,
        modelValue: [String, Number, Boolean],
    },
    emits: ['update:modelValue'],
    data() {
        return {
            selected: this.modelValue,
        }
    },
    watch: {
        selected(selected) {
            this.$emit('update:modelValue', selected)
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
    },
}
</script>
