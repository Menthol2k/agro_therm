<template>
    <li v-if="ready && rolesPermited($page.props.auth.user.id)"
        :class="isUrl(route) ? 'text-gray-800 rounded-md  px-2 py-1' : 'hover:text-gray-600 rounded-md px-2 py-1'"
        :key="route">
        <Link class="flex items-center group py-1" :href="route">
            <div class="group flex items-center  text-sm font-bold tracking-wide rounded-md hover:text-gray-800"> 
                <i class="fas fa-tachometer-alt mr-3"></i>
                {{ name }}
            </div>
        </Link>
    </li>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
    Link,
    },
    props: {
        name: { required: true },
        route: { required: true },
    },
    data() {
        return {
            ready: false,
            userRoles: [1,2,3],
        };
    },
    mounted() {
        this.ready = true;
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1);
            if (urls[0] === "") {
                return currentUrl === "";
            }
            
            return urls.filter((url) => currentUrl.startsWith(url)).length;
        },
        rolesPermited (role) {
            return this.userRoles.indexOf(role) > -1;
        }
    },
};
</script>