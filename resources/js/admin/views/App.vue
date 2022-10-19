<template>
    <div v-if="isAuth" id="app">
        <side-bar></side-bar>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <page-title></page-title>

            <div class="page-content">
                <section class="row">
                    <router-view :key="$route.fullPath"/>
                </section>
            </div>
            <page-footer/>
        </div>
    </div>
    <div v-else>
        <router-view :key="$route.fullPath"/>
    </div>
</template>
<script>
import SideBar from "./Components/SideBar"
import PageTitle from "./Components/PageTitle"
import PageFooter from "./Components/PageFooter"

export default {
    components: {SideBar, PageTitle, PageFooter},
    computed: {
        isAuth() {
            return this.$store.getters.isAuth
        }
    },
    data(){
        return {
        }
    },
    mounted() {

    },
    methods : {
        refresh(){

        }
    }
}
</script>
<style scoped>
    .page-content{
        min-height: 500px;
    }
</style>
