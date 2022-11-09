<template>
    <div>
        <header-wrap></header-wrap>
        <div class="page-wrap">
            <div class="side-bar">
                <side-menu></side-menu>
            </div>
            <div class="content">
                <router-view :key="$route.fullPath"/>
            </div>
        </div>
        <footer-wrap></footer-wrap>
    </div>

</template>

<script>

import FooterWrap from "./Components/Footer/FooterWrap";
import HeaderWrap from "./Components/Header/HeaderWrap";
import SideMenu from "./Components/Sidebar/SideMenu";

export default {
    components: {FooterWrap, HeaderWrap, SideMenu},
    created() {
        let language = localStorage.getItem('language') ?? 1;
        this.$store.dispatch('setLanguage', language);
    },
    mounted () {

        this.$store.dispatch('getInfo');
    }
}
</script>

<style scoped>
    .page-wrap{
        display: flex;
    }

    .side-bar{
        width: 245px;
        margin-right: 24px;
        background-color: #fff;
        padding: 24px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.04), 0px 14px 24px rgba(0, 0, 0, 0.07);
    }

    .content{
        width: 100%;
        background-color: #fff;
        padding: 24px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.04), 0px 14px 24px rgba(0, 0, 0, 0.07);
    }
</style>
