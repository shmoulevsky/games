<template>
    <ul class="tags">
        <li v-for="(item, key) in menu">
            <router-link :to="{path : item.url}">{{item.title}}</router-link>
        </li>
    </ul>
</template>

<script>
export default {
    name: "TagList",
    data(){
        return {
            menu : [
                {"title" : "Math", "url" : "/"},
                {"title" : "Geometry", "url" : "/games"},
                {"title" : "5-6", "url" : "/blog"},
                {"title" : "Logic", "url" : "/about"},
            ]
        }
    }
}
</script>

<style scoped>
    .tags{
        display: flex;
    }

    .tags li{
        display: flex;
    }
</style>
