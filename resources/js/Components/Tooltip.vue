<template>
	<div :class="`tooltip ${position}`" @mouseover="hover = true"  @mouseleave="hover = false" >
		<div class="flex-1 w-full max-w-64 ">
			<slot></slot>
				<div v-if="hover" class="tooltip-text">
					{{ message }}
				</div>
		</div>
	</div>
</template>

<script>
export default {
    props:{ message:String,
       position: String,

    },

 data() {
    return {
      hover: false,
    };
  }
}
</script>
<style>
 .tooltip {
  position: relative;
  display: inline-block;
}
.tooltip .tooltip-text {
  visibility: hidden;
  width: auto;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  opacity: 0;
  transition: opacity 0.3s;

}
/* Tooltip top content */
.top .tooltip-text {
  bottom: 100%;
  left: 50%;
  margin-left: -60px; /* 120/2 = 60 */
}
/* Tooltip right content */
.right .tooltip-text {
  top: -5px;
  left: 110%;
}
/* Tooltip bottom content */
.bottom .tooltip-text {
  top: 100%;
  left: 50%;
  margin-left: -60px; /* 120/2 = 60 */
}
/* Tooltip left content */
.left .tooltip-text {
  top: -5px;
  right: 110%;
}
.tooltip .tooltip-text::after {
  content: "";
  position: absolute;
  border-width: 5px;
  border-style: solid;
}
/* Tooltip top arrow */
.top .tooltip-text::after {
  margin-left: -5px;
  left: 50%;
  top: 100%;
  border-color: #555 transparent transparent transparent;
}
/* Tooltip bottom arrow */
.bottom .tooltip-text::after {
  margin-left: -5px;
  bottom: 100%;
  left: 50%;
  border-color: transparent transparent #555 transparent;
}
/* Tooltip left arrow */
.left .tooltip-text::after {
  top: 50%;
  margin-top: -5px;
  left: 100%;
  border-color: transparent transparent transparent #555;
}
/* Tooltip right arrow */
.right .tooltip-text::after {
  top: 50%;
  margin-top: -5px;
  right: 100%;
  border-color: transparent #555 transparent transparent;
}
.tooltip:hover .tooltip-text {
  visibility: visible;
  opacity: 1;
}
</style>
