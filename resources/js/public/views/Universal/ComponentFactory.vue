<template>
    <component :is="name"/>
</template>

<script>
import Game from "../Games/Game";
import GameCategory from "../Games/GameCategory";
import Page from "../Page/Page";
import PageCategory from "../Page/PageCategory";
import Article from "../Article/Article";
import ArticleCategory from "../Article/ArticleCategory";
import UrlService from "../../services/UrlService";

export default {
    name: "ComponentFactory",
    data(){
        return {
            name : null
        }
    },
    components : {Game, GameCategory, Page, PageCategory, Article, ArticleCategory},
    mounted() {

        UrlService.getByUrl(this.$route.query.page).then(
            (response) => {

            }
        )

        let type = 'page';

        switch (type){
            case 'game_category' : this.name = 'GameCategory'; break;
            case 'game' : this.name = 'Game'; break;
            case 'page_category' : this.name = 'PageCategory'; break;
            case 'page' : this.name = 'Page'; break;
            case 'article_category' : this.name = 'ArticleCategory'; break;
            case 'article' : this.name = 'Article'; break;
        }

    }

}
</script>

<style scoped>

</style>
