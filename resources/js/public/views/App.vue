<template>
    <div>
        <header-wrap></header-wrap>
        <div class="main content-wrap">
            <router-view :key="$route.fullPath"/>
        </div>
        <footer-wrap></footer-wrap>
    </div>

</template>

<script>

import FooterWrap from "./Components/Footer/FooterWrap";
import HeaderWrap from "./Components/Header/HeaderWrap";

export default {
    components: {FooterWrap, HeaderWrap},
    created() {

    }
}
</script>

<style scoped>

</style>
