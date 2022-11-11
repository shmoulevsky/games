<template>
    <span class="title">{{$t('Our games')}}</span>
    <ul class="side-menu">
        <li v-for="(item, key) in menu">
            <router-link :to="{path : item.url}">{{item.title}}</router-link>
        </li>
    </ul>
</template>

<script>
export default {
    name: "SideMenu",
    data(){
        return {
        }
    },
    computed : {
        menu(){
            return this.$store.getters.getSideMenu ?? [];
        }
    }
}
</script>

<style scoped>
.title{
    font-weight: 700;
    font-size: 20px;
    margin-bottom: 24px;
    display: block;
}
.side-menu li{
    list-style-type: none;
}
.side-menu li a{
    display: block;
    padding: 10px 0px;
    color: #222;
    font-size: 17px;
    text-decoration: none;
}
</style>
