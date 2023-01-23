<template>
    <h1>{{game.title}}</h1>
    <div class="back-wrap">
        <router-link class="back" :to="{path : '/games'}">{{$t('To games list')}}</router-link>
    </div>
    <div class="game">
        <canvas v-if="isLoad" :width="width" :height="height" class="game-canvas" id="game-canvas"></canvas>
        <canvas v-if="isLoad" width="61" height="61" class="card-canvas" id="card-canvas"></canvas>
    </div>
    <div class="rules">
        {{game.rules}}
    </div>
    <div class="info">
        <div class="aim">{{$t('Aim')}}: Develop math</div>
        <div class="age">{{$t('Age')}}: 4-5</div>
    </div>


    <div class="back-wrap">
        <router-link class="back" :to="{path : '/games'}">{{$t('To games list')}}</router-link>
    </div>

</template>

<script>

import GameService from "../../services/GameService";

export default {
    name: "Game",
    props : ["params"],
    data() {
        return {
            game : {title : '', rules : ''},
            width : 0,
            height : 0,
            isLoad : false,
        }
    },
    mounted() {
        this.init();
    },
    methods : {
        init(){

            let gameScript = window.document.createElement('script');
            this.game = this.params.data.page ?? null;

            if (this.game.game) {
                this.width = 800;
                this.height = 600;
                this.language = localStorage.getItem('language');
                this.script = this.game.game;


                this.isLoad = true;
                gameScript.setAttribute('src', this.game.game);
                gameScript.setAttribute('type', 'text/javascript');
                gameScript.setAttribute('async', 'true');
                document.body.appendChild(gameScript);
            }


        }
    }

}
</script>

<style scoped>
    .game{
        width: 800px;
        margin: 0px auto;
        margin-left: 245px;
    }

    .game-canvas{
        border: 1px solid #ccc;
    }

    .rules{
        line-height: 24px;
        margin: 24px 0px;
    }

    .back{
        color: #111;
    }

    .info{
        margin: 24px 0px;
        font-size: 14px;
    }

</style>
