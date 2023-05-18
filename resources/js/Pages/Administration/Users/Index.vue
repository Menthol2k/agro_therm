<template>
	<div>
		<Head title="Utilizatori" />
		<Title>Utilizatori</Title>
		<div class="align-middle inline-block min-w-full bg-gray-100 shadow-md overflow-hidden sm:rounded-lg animate__animated animate__fadeIn animate__faster">
			<div class="p-2 mb-4 flex justify-between space-x-2">
				<div class="relative inline-block text-left w-14">
					<select v-model.number="params.perPage" class="w-full form-control rounded-md border border-gray-300 shadow-sm px-2 py-2 bg-white text-sm font-medium text-gray-700 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-gray-600">
						<option :value="10"> 10 </option>
						<option :value="15"> 15 </option>
						<option :value="25"> 25 </option>
					</select>
				</div>
				<div class="flex-1 flex">
					<div class="relative w-full text-gray-400 focus-within:text-gray-600">
						<div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
							<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
							</svg>
						</div>
						<input id="search"  v-model="params.search" class="block w-full h-full pl-8 pr-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-gray-600 sm:text-sm" placeholder="Search" type="search" name="search">
					</div>  
				</div>
				<Link class="inline-flex items-center px-4 py-1 border border-transparent text-md rounded-md shadow-sm text-white font-bold bg-blue-400 hover:bg-blue-500 focus:outline-none"
					href="/administration/users/create"
					v-if="$page.props.can.create">
					Adauga utilizator
				</Link>
			</div>     
			<div class="">
				<table class="min-w-full divide-y divide-gray-50">
					<thead class="">
						<tr>
							<Heading multi-column 
								:direction="filters.direction"
								:selected="filters.field === 'name'"
								@removeSort="removeSort"
								@sort="sort('name')">
								Nume
							</Heading>
							<Heading >
								Rol
							</Heading>
							<Heading multi-column 
								:direction="filters.direction"
								:selected="filters.field === 'email'"
								@removeSort="removeSort"
								@sort="sort('email')">
								Email
							</Heading>
							<Heading multi-column 
								:direction="filters.direction"
								:selected="filters.field === 'phone'"
								@removeSort="removeSort"
								@sort="sort('phone')">
								Telefon
							</Heading>
							<Heading multi-column 
								:direction="filters.direction"
								:selected="filters.field === 'obs'"
								@removeSort="removeSort"
								@sort="sort('obs')">
								Observatii
							</Heading>
							<th scope="col" class="px-4 py-2 text-right text-sm text-gray-700 tracking-wider">
								Actiuni
							</th>
						</tr>
					</thead>
					<tbody class="">
						<tr v-if="users.data.length === 0"  class="bg-white border-b">
							<td  colspan="8" class="py-2 text-gray-500 text-md text-center">
								Nu au fost gasite inregistrari
							</td>
						</tr>
						<tr v-else v-for="(user) in users.data" :key="user.id" class="bg-white border-b hover:bg-gray-100">
							<td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500">
								{{ user.name }}
							</td>
							<td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500">
								{{ user.role }}
							</td>
							<td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
								{{ user.email }}
							</td>
							<td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
								{{ user.phone }}
							</td>
							<td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
								{{ user.obs }}
							</td>
							<td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
								<div class="flex justify-end">
									<Link class="flex items-center text-gray-400 hover:text-gray-700 hover:fond-bold" :href="('/administration/users/'+user.id+'/edit')" tabindex="-1">
										<i class="fas fa-pencil-alt"></i>        
									</Link>
								</div>
							</td>
						</tr>
					</tbody>
				</table> 
				<div class="p-4">
					<pagination :name="users"
						:links="users.links"
						v-if="users.total > perPage"/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Layout from "@/Components/Layout.vue";
import Heading from '@/Components/Table/Heading.vue'
import Title from '@/Components/Title.vue';
import Pagination from "@/Components/Pagination.vue"
import {Head, Link} from '@inertiajs/inertia-vue3'
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";
import mapValues from 'lodash/mapValues'

export default {
  components: {
    Head, Link, Pagination, Heading, Title
  },
	data() {
		return {
			params: {
				search: this.filters.search,
				field: this.filters.field,
				direction: this.filters.direction,
				perPage: this.perPage
			},
		};
	},
  	layout: Layout,

	props: {
		users: Object,
		filters: Object,
		perPage: Number
	},

	methods: {
		sort(field) {
			this.params.field = field;
			this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
		},
		removeSort() {
			this.filters.direction = null;
			this.filters.field = null;
			this.params.direction = null;
			this.params.field = null;
			
		},
		reset() {
			this.params = mapValues(this.params, () => null)
		},
	},
	watch: {
		params: {
			deep: true,
			handler: throttle(function() {
				let query = pickBy(this.params)
				this.$inertia.get('users',Object.keys(query).length ? query : { remember: 'forget' }, { preserveState: true })         
			},150 ),
		},
	},
};
</script>