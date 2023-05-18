<template>
<div class="mx-auto py-2 ">
  <h1 class="text-xl font-semibold text-gray-900">{{title}} <slot></slot> </h1>
</div>
</template>
<script>
export default {
    props: {
        title: String
    }
}
</script>