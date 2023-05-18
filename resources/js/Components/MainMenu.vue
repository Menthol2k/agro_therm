<template>
    <div class="main-menu relative">
        <transition-group name="list" tag="ul">
        
        <li v-if="$page.props.auth.can.viewDashboard"
            :class="isUrl('dashboard') ? 'text-gray-800 rounded-md px-2 py-1 font-bold' : 'text-gray-600 hover:text-gray-700 font-semibold hover:font-extrabold rounded-md px-2 py-1'"
            key="dashboard">
            <Link class="flex items-center group py-1" href="/dashboard">
                <div class="group flex items-center tracking-wide rounded-md"> 
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </div>
            </Link>
        </li>
        <li v-if="$page.props.auth.can.viewAdministration" 
            class="flex justify-between text-gray-600 hover:text-gray-700 hover:font-extrabold rounded-md px-2 py-1"
            :class="isUrl('administration') ? 'text-gray-800 rounded-md px-2 py-1 font-bold' : 'text-gray-600 hover:text-gray-700 font-semibold hover:font-extrabold rounded-md px-2 py-1'"
            key="administrare"
            style="position: relative">
            <button class="flex-1 flex items-center group py-1" @click="toggleAdminMenu">
                <div class="w-full flex items-center font-bold tracking-wide rounded-md ">
                    <i class="fas fa-cogs mr-3"></i>
                    Administrare
                </div>
            </button>
            <div class="" :class="adminMenu ? 'transition duration-300 transform -rotate-180':' transition duration-300'">
                <i class="fas fa-chevron-up" ></i>
            </div>
        </li>
        <li v-if="adminMenu && $page.props.auth.can.viewUsers" class="pl-5"
            key="users">
            <div :class="isUrl('administration/users') ? 'text-gray-800 rounded-md px-2 py-1 font-bold' : 'text-gray-600 hover:text-gray-700 font-semibold hover:font-extrabold rounded-md px-2 py-1'">
                <Link class="flex items-center group py-1" href="/administration/users">
                    <div class="group flex items-center tracking-wide rounded-md">
                        <i class="fas fa-user mr-3"></i>
                        Utilizatori
                    </div>
                </Link>
            </div>
        </li>
        <li v-if="adminMenu && $page.props.auth.can.viewRoles" class="pl-5"
            key="roles">
            <div :class="isUrl('administration/roles') ? 'text-gray-800 rounded-md px-2 py-1 font-bold' : 'text-gray-600 hover:text-gray-700 font-semibold hover:font-extrabold rounded-md px-2 py-1'">
                <Link class="flex items-center group py-1" href="/administration/roles">
                    <div class="group flex items-center tracking-wide rounded-md">
                        <i class="fas fa-user mr-3"></i>
                        Roluri
                    </div>
                </Link>
            </div>
        </li>
        <li v-if="adminMenu && $page.props.auth.can.viewPermissions" class="pl-5"
            key="permissions">
            <div :class="isUrl('administration/permissions') ? 'text-gray-800 rounded-md px-2 py-1 font-bold' : 'text-gray-600 hover:text-gray-700 font-semibold hover:font-extrabold rounded-md px-2 py-1'">
                <Link class="flex items-center group py-1" href="/administration/permissions">
                    <div class="group flex items-center tracking-wide rounded-md">
                        <i class="fas fa-user mr-3"></i>
                        Permisii
                    </div>
                </Link>
            </div>
        </li>
        </transition-group>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import MenuLink from "./MenuLink";

export default {
    components: {
    MenuLink,
    Link,
    },
    data() {
        return {
            adminMenu: false,
            userRoles: [1,2,3],
        };
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1);
            if (urls[0] === "") {
                return currentUrl === "";
            }
            
            return urls.filter((url) => currentUrl.startsWith(url)).length;
        },
        toggleAdminMenu: function () {
            this.adminMenu = !this.adminMenu;
        },
        rolesPermited (role) {
            return this.userRoles.indexOf(role) > -1;
        }
    },
};
</script>
<style>
  .main-menu ul {
    position: relative;
    padding: 0;
  }

  .list-enter-from {
    opacity: 0;
    transition: all 0.4s ease;
  }
  .list-enter-active {
    transition: all 0.4s ease;
  }
  .list-leave-to {
    opacity: 0;
  }
  .list-leave-active {
    transition: all 0.4s ease;
    position: absolute;
  }
  .list-move {
    transition: all 0.3s ease;
  }
    
</style>