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

ul.top-menu{
    padding-top: 10px;
    display: flex;
    margin: 0px;
}
.top-menu li{
    list-style: none;
}

.top-menu li a{
    font-family: 'Montserrat';
    color:#111;
    text-decoration: none;
    padding: 5px 5px;
    font-style: normal;
    font-weight: 500;
    font-size: 17px;
    line-height: 170%;
    margin-right: 24px;
}

.top-menu li a.router-link-active{
    border-bottom: 2px solid #6e41e2;
}
</style>
