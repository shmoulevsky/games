<template>
    <ul class="tags">
        <li v-for="(tag, key) in this.tagProps">
            <router-link
                :class="tag.selected ? 'selected': ''"
                :to="{path : tag.url }"
            >
                {{tag.title}}
            </router-link>
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

        }
    }
}
</script>

<style scoped>
    .tags{
        display: flex;
        margin: 0px;
        padding: 0px;
    }

    .tags li{
        display: flex;
        margin-right: 10px;
    }

    .tags li a{
        border: 1px solid #6e41e2;
        border-radius: 10px;
        padding: 5px 15px;
        font-size: 15px;
        color: #222;
        text-decoration: none;
    }

    .tags li a.selected{
        background-color: #6e41e2;
        border: 1px solid #6e41e2;
        color: #fff;
    }
</style>
