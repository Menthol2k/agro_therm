<template>
  <div :class="$attrs.class" class="flex flex-col">
    <label v-if="label" class="form-label block text-sm font-black leading-5 text-gray-700" :for="id">{{ label }}</label>
    <textarea :id="id" ref="input" v-bind="{ ...$attrs, class: null }" class="mt-1 form-textarea rounded-lg" :class="{ error: error }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
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
        return `textarea-input-${uuid()}`
      },
    },
    error: String,
    label: String,
    modelValue: String,
  },
  emits: ['update:modelValue'],
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
