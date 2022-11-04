<template>
    <header>
        <div class="content-wrap flex space-between align-items-center">
            <logo></logo>
            <auth-menu></auth-menu>
        </div>
    </header>
    <top-menu></top-menu>
</template>

<script>

import AuthMenu from "./AuthMenu";
import Logo from "./Logo";
import TopMenu from "./TopMenu";

export default {
    name: "HeaderWrap",
    components: {Logo, TopMenu, AuthMenu}
}
</script>

<style scoped>

</style>
