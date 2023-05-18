<template>
	<transition name="slide-fade" v-if="$page.props.toast.success && visible && !popstate">
		<div class="z-10 absolute flex max-w-sm w-full mt-4 mr-4 top-0 right-0 mx-auto bg-white shadow-md rounded-lg overflow-hidden animate__animated animate__fadeInDown">
			<div class="flex justify-center items-center w-12 bg-green-500">
				<svg  class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"
				></path>
				</svg>
			</div>
			<div class="-mx-3 py-2 px-4">
				<div class="mx-3">
					<span class="text-green-500 font-semibold">Succes</span>
					<p class="text-gray-600 text-sm"> {{$page.props.toast.success.message}}</p>
				</div>
			</div>
		</div>
	</transition>
	<transition name="slide-fade" v-if="$page.props.toast.error && visible && !popstate">
		<div class="z-10 absolute flex max-w-sm w-full mt-4 mr-4 top-0 right-0 mx-auto bg-white shadow-md rounded-lg overflow-hidden">
			<div class="flex justify-center items-center w-12 bg-red-500">
				<svg  class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"
				></path>
				</svg>
			</div>
			<div class="-mx-3 py-2 px-4">
				<div class="mx-3">
				<span class="text-red-500 font-semibold">Eroare</span>
				<p class="text-gray-600 text-sm"> {{$page.props.toast.error.message}}</p>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
export default {

    props: {
        toast: Object,
        popstate: Boolean
    },

    data() {
        return {
          visible: false,
          timeout : null
        }

    },
    watch: {
        '$page.props.toast': {
            deep:true,
            handler() {
                this.visible = true;
                if(this.timeout) {
                    clearTimeout(this.timeout);
                }
               this.timeout = setTimeout(()=> this.visible = false, 3000)
            }
        }
    }
}
</script>

<style>
.slide-fade-enter-from {
    opacity: 0;
    transition: all 0.4s ease;
  }
  .slide-fade-enter-active {
    transition: all 0.4s ease;
  }
  .slide-fade-leave-to {
    opacity: 0;
  }
  .slide-fade-leave-active {
    transition: all 0.4s ease;
    position: absolute;
  }
  .slide-fade-move {
    transition: all 0.3s ease;
  }
</style>