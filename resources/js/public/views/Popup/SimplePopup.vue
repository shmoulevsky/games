<template>
    <div @click="hidePopup()" v-show="isShow" class="bg"></div>
    <div v-show="isShow" class="popup-wrap">
        <svg class="close"
             @click="hidePopup()"
            width="27.928837"
            height="27.928837"
            viewBox="0 0 7.3895045 7.3895046"
            version="1.1"
            id="svg5"
            xml:space="preserve"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:svg="http://www.w3.org/2000/svg"><defs
     id="defs2" /><g
            id="layer1"
            transform="translate(-211.73301,-74.774411)"><path
       style="fill:#ffffff;stroke-width:0.529167"
       d="m 211.33753,81.884997 13.47267,1.054252"
       id="path391" /><g
            id="g1104"
            transform="matrix(0.46699739,0.46699739,-0.46699739,0.46699739,161.59555,-60.400325)"
            style="fill:#666666;stroke:#898989;stroke-width:1.51416;stroke-opacity:1"><path
         style="fill:#666666;stroke:#898989;stroke-width:1.60248;stroke-linecap:round;stroke-dasharray:none;stroke-opacity:1"
         d="m 199.5413,91.046838 h 13.55719"
         id="path456" /><path
            style="fill:#666666;stroke:#898989;stroke-width:1.60248;stroke-linecap:round;stroke-dasharray:none;stroke-opacity:1"
            d="M 206.31989,97.825433 V 84.268243"
            id="path456-3" /></g></g></svg>
        <div class="popup-inner">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "SimplePopup",
    props : ['isShow'],
    methods : {
        hidePopup(){
            this.$emit('hidePopup');
        }
    }
}
</script>

<style scoped>
.bg{
    background-color: rgba(0,0,0,0.75);
    position: fixed;
    top:0px;
    left: 0px;
    bottom: 0px;
    right: 0px;
    z-index: 10;
}

.popup-wrap{
    position: absolute;
    top: 100px;
    left: 50%;
    z-index: 11;
    width: 500px;
    margin-left: -250px;
    background: #fff;
    border-radius: 30px;
    padding: 20px 40px 30px;
}

.close{
    position: absolute;
    right: 20px;
    top: 20px;
    cursor: pointer;
}

.close:hover{
    fill: #6E41E2;
}

.popup-inner{

}
</style>
