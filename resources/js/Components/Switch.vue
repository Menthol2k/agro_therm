<template>
  <button
    class="w-14 h-8 flex items-center bg-gray-300 rounded-full p-1 duration-300 cursor-pointer"
    :class="{ 'bg-green-500': value }"
    :aria-checked="value.toString()"
    @click="value= !value"
  >
    <div
      class="bg-white w-6 h-6 rounded-full shadow-md transform duration-300"
      :class="{ 'translate-x-6': value }"
    ></div>
  </button>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      
    },
  },
  methods: {
    toggle() {
      this.$emit('input', !this.value);
      
    },
  },
};
</script>