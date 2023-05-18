<template>
    <div>
        <Head title="Dashboard" />
        <Title>Dashboard</Title>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import Title from "@/Components/Title.vue";
import Layout from "@/Components/Layout.vue";

export default {
  components: {
    Head,
    Title
  },

  layout: Layout,
    setup () {
        const beforeRenderLogic = (event) => {
    }    

    return {
      beforeRenderLogic
    }
  },
  props: {
    
  },
};
</script>