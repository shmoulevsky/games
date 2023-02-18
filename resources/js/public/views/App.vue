<template>
    <router-view :key="$route.fullPath"/>
</template>

<script>

import FooterWrap from "./Components/Footer/FooterWrap";
import HeaderWrap from "./Components/Header/HeaderWrap";
import SideMenu from "./Components/Sidebar/SideMenu";
import AppInfoService from "../services/AppInfoService";


export default {
    components: {FooterWrap, HeaderWrap, SideMenu},
    created() {

    },
    mounted () {
        AppInfoService.getInfo().then(response => {
            this.$store.dispatch('setInfo', response.data);
            let language = localStorage.getItem('language') ?? 1;
            this.$store.dispatch('setLanguage', language);
        });
    }
}
</script>
