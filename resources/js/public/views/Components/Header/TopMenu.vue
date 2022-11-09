<template>
    <ul class="top-menu">
        <li v-for="(item, key) in menu">
            <router-link :to="{path : item.url}">{{item.title}}</router-link>
        </li>
    </ul>

</template>

<script>
export default {
    name: "TopMenu",
    data(){
        return {
        }
    },
    computed : {
        menu(){
            return this.$store.getters.getTopMenu;
        }
    }
}
</script>

<style scoped>

    .top-menu{
        display: flex;
    }

    .top-menu li{
        list-style-type: none;
    }

    .top-menu li a{
        display: flex;
        padding: 10px 20px;
        color: #222;
        font-size: 18px;
        text-decoration: none;
    }
</style>
