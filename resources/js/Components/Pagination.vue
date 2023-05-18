<template>
  <div class="flex justify-between items-center"
  	v-if="links.length > 3">
	<div>
		<div class="text-sm text-gray-700 leading-5">
          Showing <span class="font-black">{{name.from}}</span>  to <span class="font-black">{{name.to}}</span>  of <span class="font-black">{{name.total }}</span> records 
        </div >
	</div>
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-2 py-1 text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
        <Link v-else :key="`link-${key}`" class="mb-1 mr-1 px-2 py-1 h-max text-sm leading-4 hover:bg-white hover:text-gray-900 border border-gray-300 focus:shadow rounded-md" :class="{ 'bg-blue-500 text-white shadow-none': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
	  name: Object
  },
}
</script>
