<template>
    <th class ="px-4 py-3 bg-cool-gray-50">
        <div class="flex items-center">
            <span v-if="sortable" class="text-left text-sm leading-4 text-gray-700 font-bold tracking-wider">
                <slot></slot>
            </span>
            <button @click="$emit('sort')" v-else class="flex items-center space-x-1 text-left text-sm leading-4 text-gray-700 font-bold tracking-wider group focus:outline-none">
                <span><slot></slot></span>
                <span v-if="multiColumn" class="relative flex items-center">
                    <i v-if="selected && direction === 'asc'" class="fas fa-sort-up text-gray-400 hover:text-gray-700"></i>
                    <i v-else-if="selected && direction === 'desc'" class="fas fa-sort-down text-gray-400 hover:text-gray-700"></i>                    
                    <i v-else class="fas fa-sort text-gray-400 hover:text-gray-700"></i>
                </span>
                <span v-else>
                    <i v-if="selected && direction === 'asc'" class="fas fa-sort-up text-gray-400 hover:text-gray-700"></i>
                    <i v-else-if="selected && direction === 'desc'" class="fas fa-sort-down text-gray-400 hover:text-gray-700"></i>              
                    <i v-else class="fas fa-sort text-gray-400 hover:text-gray-700"></i>
                </span>         
            </button>
            <span v-if="selected">
                <button class="flex items-center space-x-1 text-left text-sm leading-4 text-gray-700 font-bold tracking-wider group focus:outline-none"
                    @click="$emit('removeSort')">
                    <i class="ml-1s fas fa-times-circle text-red-400 hover:text-red-700"></i>
                </button>
            </span>
        </div>
</th>
</template>

<script>
export default {
    props: {
        sortable: null,
        direction: null,
        selected: false,
        removeSort: false,
        multiColumn: null
    }
}
</script>
