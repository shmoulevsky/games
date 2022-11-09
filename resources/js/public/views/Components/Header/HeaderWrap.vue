<template>
    <header class="flex space-between align-items-center">
        <logo></logo>
        <top-menu></top-menu>
        <language-select></language-select>
        <auth-menu></auth-menu>
    </header>

</template>

<script>

import AuthMenu from "./AuthMenu";
import Logo from "./Logo";
import TopMenu from "./TopMenu";
import LanguageSelect from "./LanguageSelect";

export default {
    name: "HeaderWrap",
    components: {Logo, TopMenu, AuthMenu, LanguageSelect}
}
</script>

<style scoped>

</style>
