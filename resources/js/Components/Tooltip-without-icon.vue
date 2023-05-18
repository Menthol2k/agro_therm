<template>
    <div class="relative z-150 inline-flex">
    <div class="tooltip w-full max-w-64">
    <slot></slot>
            
            <div v-if="message" class="tooltip-text w-max bg-red-300 text-gray-700 -ml-6 -mt-1132 rounded shadow-lg">
                {{ message }}
            </div>
        
    </div>
</div>
</template>

<script>
export default {
    props: ['message']
}
</script>