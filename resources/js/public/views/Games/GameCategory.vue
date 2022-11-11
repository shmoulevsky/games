<template>
    <h1>Games</h1>
    <div class="tags-wrap">
        <tag-list :tagProps="tags"></tag-list>
    </div>
    <div class="game" v-for="(game, key) in this.games">
        <router-link :style="{backgroundImage: 'url(' + game.thumb + ')' }"
                     class="picture"
                     :to="{path : game.url}">
        </router-link>
        <div class="info">
            <router-link class="title" :to="{path : game.url}">{{game.title}}</router-link>
            <div class="aim">{{$t('Aim')}}: Develop math</div>
            <div class="age">{{$t('Age')}}: 4-5</div>
            <div class="description">{{$t('Description')}}: {{game.description}}</div>
            <div class="more">
                <router-link class="more-btn" :to="{path : game.url}">{{$t('Play')}}</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import TagList from "../Components/Page/TagList";
import TagService from "../../services/TagService";

export default {
    name: "GameCategory",
    components: {TagList},
    props : ["params"],
    data(){
        return {
            games : {},
            tags : {}
        }
    },
    computed : {

    },
    mounted() {
        this.games = this.params.data.list.data;

        let type = this.params.data.type ?? null;
        let categoryId = this.params.data.page.id ?? null;

        TagService.getByCategory(categoryId, type, window.location.pathname).then((response) => {
            this.tags = response.data.tags;
        })

    }
}
</script>

<style scoped>
    .tags-wrap{
        margin: 24px 0px;
    }
    .game{
        margin-bottom: 36px;
        padding-bottom: 36px;
        border-bottom: 1px solid #ccc;
        display: flex;
    }

    .picture{
        width: 489px;
        height: 370px;
        background-size: cover;
        background-repeat: no-repeat;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.04), 0px 14px 24px rgba(0, 0, 0, 0.07);
    }

    .info{
        width: 800px;
        margin-left: 24px;
    }

    .title{
        font-weight: 400;
        font-size: 24px;
        line-height: 33px;
        margin-bottom: 24px;
        color: #222;
        display: block;
    }

    .description{
        font-size:16px;
        margin-bottom: 8px;
        line-height:24px;
    }

    .aim{
        font-size:16px;
        margin-bottom: 8px;
    }

    .age{
        font-size:16px;
        margin-bottom: 8px;
    }

    .more{
        margin-top: 24px;
    }


</style>
