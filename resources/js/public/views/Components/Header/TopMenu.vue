<template>
    <ul class="top-menu">
        <li v-for="(item, key) in menu">
            <router-link
                :to="{path : item.url}"
                :class="item.selected ? 'selected' : ''"
            >
                {{item.title}}
            </router-link>
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
            let items = this.$store.getters.getTopMenu;
            return items ?? [];
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

    .top-menu li a.router-link-active{
       border-bottom: 2px solid #6e41e2;
    }
</style>
