<template>
    <div class="h-screen" style="background-color: #EAECEE ">
        <TransitionRoot as="template" :show="sidebarOpen">
			<Dialog as="div" class="relative z-40 md:hidden" @close="sidebarOpen = false">
				<TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
					<div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
				</TransitionChild>

				<div class="fixed inset-0 z-40 flex">
					<TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
						<DialogPanel class="relative max-w-xs w-full bg-white pt-5 pb-4 flex-1 flex flex-col">
						<TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
							<div class="absolute top-0 right-0 -mr-12 pt-2">
							<button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
								<span class="sr-only">Close sidebar</span>
								<XIcon class="h-6 w-6 text-white" aria-hidden="true" />
							</button>
							</div>
						</TransitionChild>
						<div class="flex-shrink-0 px-4 flex items-center">
							<Link href="/dashboard">
								<img class="h-12 w-auto" src="/images/logo.png" alt="logo" />
							</Link>
						</div>
						<div class="mt-5 flex-1 h-0 overflow-y-auto">
							<nav class="px-2 space-y-1">
							<a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group rounded-md py-2 px-2 flex items-center text-base font-medium']">
								<component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
								{{ item.name }}
							</a>
							</nav>
						</div>
						</DialogPanel>
					</TransitionChild>
				<div class="flex-shrink-0 w-14">
				</div>
				</div>
			</Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 animate__animated animate__fadeInLeft">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
			<div class="border-r border-gray-200 pt-5 flex flex-col flex-grow bg-white overflow-y-auto">
				<div class="flex-shrink-0 px-4 flex items-center">
					<Link href="/dashboard">
						<img class="h-12 w-auto" src="/images/logo.png" alt="logo" />
					</Link>
				</div>
				<div class="flex-grow mt-5 flex flex-col">
					<nav class="flex-1 px-2 pb-4 space-y-1">
						<MainMenu></MainMenu>
					</nav>
				</div>
			</div>
        </div>
        <div class="md:pl-64">
			<div class="flex flex-col md:px-8 xl:px-0 animate__animated animate__fadeInDown">
				<div class="sticky top-0 z-10 flex-shrink-0 h-16 bg-white border-b border-gray-200 flex">
					<button type="button" class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="sidebarOpen = true">
						<span class="sr-only">Open sidebar</span>
						<MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
					</button>
					<div class="flex-1 flex justify-between px-4 md:px-0">
						<div class="flex-1 flex">
							<!-- <form class="w-full flex md:ml-0" action="#" method="GET">
								<label for="search-field" class="sr-only">Search</label>
								<div class="relative w-full text-gray-400 focus-within:text-gray-600">
								<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
									<SearchIcon class="h-5 w-5" aria-hidden="true" />
								</div>
								<input id="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Search" type="search" name="search" />
								</div>
							</form> -->
						</div>
						<div class="ml-4 flex items-center md:ml-6  md:pr-8">
							<!-- <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								<span class="sr-only">View notifications</span>
								<BellIcon class="h-6 w-6" aria-hidden="true" />
							</button> -->

							<!-- Profile dropdown -->
							<Menu as="div" class="ml-3 relative">
								<div>
									<MenuButton class="max-w-xs flex items-center text-sm rounded-full focus:outline-none">
										<span class="sr-only">Open user menu</span>
										<i class="fas fa-user-circle fa-lg text-gray-400 mr-1"></i> {{$page.props.auth.user.name}} 
									</MenuButton>
								</div>
								<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
									<MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 focus:outline-none">
										<Link as="button" class="block px-6 py-2 hover:bg-gray-200 hover:text-black w-full" :href="route('logout')" method="post" >
											Logout
										</Link>
									</MenuItems>
								</transition>
							</Menu>
						</div>
					</div>
				</div>

				<main class="flex-1">
					<div class="p-6">
						<slot>

						</slot>
					</div>
				</main>
			</div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from 'vue';
import MainMenu from '@/Components/MainMenu';
import { useToast } from "vue-toastification";
import {
	Dialog,
	DialogPanel,
	Menu,
	MenuButton,
	MenuItem,
	MenuItems,
	TransitionChild,
	TransitionRoot,
} from '@headlessui/vue'
import {
	BellIcon,
	CalendarIcon,
	ChartBarIcon,
	FolderIcon,
	HomeIcon,
	InboxIcon,
	MenuAlt2Icon,
	UsersIcon,
	XIcon,
} from '@heroicons/vue/outline'
import { SearchIcon } from '@heroicons/vue/solid'

const navigation = [
	{ name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
	{ name: 'Team', href: '#', icon: UsersIcon, current: false },
	{ name: 'Projects', href: '#', icon: FolderIcon, current: false },
	{ name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
	{ name: 'Documents', href: '#', icon: InboxIcon, current: false },
	{ name: 'Reports', href: '#', icon: ChartBarIcon, current: false },
]
const userNavigation = [
	{ name: 'Your Profile', href: '#' },
	{ name: 'Settings', href: '#' },
	{ name: 'Sign out', href: '#' },
]

export default {
	components: {
		Link,
		MainMenu,
		Dialog,
		DialogPanel,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		TransitionChild,
		TransitionRoot,
		BellIcon,
		MenuAlt2Icon,
		SearchIcon,
		XIcon,
	},
  	setup() {
		const sidebarOpen = ref(false)

		return {
			navigation,
			userNavigation,
			sidebarOpen,
		}
	},
}
</script>