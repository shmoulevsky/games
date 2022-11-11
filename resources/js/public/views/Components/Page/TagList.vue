<template>
    <ul class="tags">
        <li v-for="(tag, key) in this.tagProps"
            @click="select(tag)"
            :class="tag.selected ? 'selected': ''"
        >
            <router-link :to="{path : tag.url }">{{tag.title}}</router-link>
        </li>
    </ul>
</template>

<script>
export default {
    name: "TagList",
    props : ["tagProps"],
    data(){
        return {
            tags : []
        }
    },
    mounted() {
        this.tags = this.tagProps;
    },
    methods : {
        select(tag){
            tag.selected = true;
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
