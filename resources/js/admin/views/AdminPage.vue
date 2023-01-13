<template>
    <div v-if="isAuth" id="app">
        <side-bar></side-bar>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
                <div class="flex-row d-flex">
                    <div class="flex-column">

                    </div>
                    <div class="flex-column d-flex end">
                        <language-select></language-select>
                    </div>
                </div>
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
import AppInfoService from "../services/AppInfoService";
import LanguageSelect from "./Components/LanguageSelect.vue";
import {mapGetters} from "vuex";

export default {
    components: {LanguageSelect, SideBar, PageTitle, PageFooter},
    computed: {
        ...mapGetters({
            userName: 'getUser',
        }),
        isAuth() {
            return this.$store.getters.isAuth;
        }
    },
    data(){
        return {
        }
    },
    created() {
        let language = localStorage.getItem('language') ?? 1;
        this.$store.dispatch('setLanguage', language);
    },
    mounted () {
        AppInfoService.getInfo().then(response => {
            this.$store.dispatch('setInfo', response.data);
        })
    },
    methods : {
        refresh(){
            //this.$store.dispatch('refreshToken')
        }
    }
}
</script>
<style scoped>
    .page-content{
        min-height: 500px;
    }
</style>
