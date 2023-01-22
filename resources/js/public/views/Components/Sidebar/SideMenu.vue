<template>
    <span class="title">{{$t('Our games')}}</span>
    <ul class="side-menu">
        <li v-for="(item, key) in menu">
            <router-link :to="{path : item.url}"><span>{{item.title}}</span></router-link>
            <ul v-if="item.children" class="side-sub-menu">
                <li v-for="(subItem, keySub) in item.children">
                    <router-link :to="{path : subItem.url}"><span>{{subItem.title}}</span></router-link>
                </li>
            </ul>
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

.side-menu .side-sub-menu li a{
    display: block;
    padding: 3px 0px;
    color: #222;
    font-size: 16px;
    text-decoration: none;
}

.side-menu li a.span{
    border-bottom: 2px solid #fff;
    padding-bottom: 2px;
}
.side-menu li a.router-link-active span{
    border-bottom: 2px solid #6e41e2;
}

</style>
