<template>
    <component :params="params" :is="name"/>
</template>

<script>
import Game from "../Games/Game";
import GameCategory from "../Games/GameCategory";
import Page from "../Page/Page";
import PageCategory from "../Page/PageCategory";
import NotFoundPage from "../Components/Page/NotFoundPage";
import Article from "../Article/Article";
import ArticleCategory from "../Article/ArticleCategory";
import UrlService from "../../services/UrlService";

export default {
    name: "ComponentFactory",
    data(){
        return {
            name : null,
            params : null,
        }
    },
    components : {Game, GameCategory, Page, PageCategory, Article, ArticleCategory, NotFoundPage},
    mounted() {

        console.log(window.location.pathname);

        UrlService.getByUrl(window.location.pathname).then(
            (response) => {

                let type = response.data.type;
                this.params = response;

                switch (type){
                    case 'game_category' : this.name = 'GameCategory'; break;
                    case 'game' : this.name = 'Game'; break;
                    case 'page_category' : this.name = 'PageCategory'; break;
                    case 'page' : this.name = 'Page'; break;
                    case 'article_category' : this.name = 'ArticleCategory'; break;
                    case 'article' : this.name = 'Article'; break;
                    case 'not_found' : this.name = 'NotFoundPage'; break;
                }
            }
        )

    }

}
</script>

<style scoped>

</style>
