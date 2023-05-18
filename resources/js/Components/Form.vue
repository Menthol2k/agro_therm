<template>
    <form 
        autocomplete="off" :class="$attrs.class">
        <div class="align-middle inline-block min-w-full bg-gray-100 shadow-md overflow-hidden sm:rounded-lg animate__animated animate__fadeIn animate__faster">
            <div class="px-4 py-5 sm:p-6">
             <slot></slot>
            </div>
            <div class="px-4 py-4 sm:px-6">
                <div class="flex justify-between">
                    <Link  @click="back" class="cursor-pointer inline-flex items-center px-4 py-2 border border-transparent shadow-sm leading-4 font-bold rounded-md text-white bg-gray-400 hover:bg-gray-500 focus:outline-none">
                        Inapoi
                        <svg class="ml-1 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                    </Link>
                    <button type="submit"
                        :disabled="loading"
                        class="px-4 py-2 border bg-green-500 border-transparent shadow-sm leading-4 text-white  font-bold rounded-md focus:outline-none">
                        <div class="w-24">
                            <div class="inline-flex items-center">
                               <span v-if="loading" class="animate-spin mr-1">
                                <i class="fas fa-spinner"></i>
                                </span>
                                Salveaza
                                <svg class="ml-1 -mr-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                 
                            </div>
                            
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {

    components: {
        Link
    },
    props: {
        type: {
            type: String,
            default: 'submit',
        },
        
        loading: Boolean
       
    },
    methods: {
        back() {
            window.history.back();
        }
    }
}
</script>

