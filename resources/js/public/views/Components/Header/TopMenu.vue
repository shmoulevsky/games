<template>
    <nav class="top-menu">
        <ul class="content-wrap">
            <li v-for="(item, key) in menu">
                <router-link :to="{path : item.url}">{{item.title}}</router-link>
            </li>
        </ul>
    </nav>

</template>

<script>
export default {
    name: "TopMenu",
    data(){
        return {
            menu : [
                {"title" : "Home", "url" : "/"},
                {"title" : "Games", "url" : "/games"},
                {"title" : "About", "url" : "/contacts"},
            ]
        }
    }
}
</script>

<style scoped>
    .top-menu{
        background-color: #02f4be;
        margin-bottom: 30px;
    }

    .top-menu ul{
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
