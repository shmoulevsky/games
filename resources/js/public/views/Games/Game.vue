<template>
    <h1>{{game.title}}</h1>
    <div class="game-wrap">
        <div class="game">
            <canvas v-if="isLoad" :width="width" :height="height" class="game-canvas" id="game-canvas"></canvas>
            <canvas v-if="isLoad" width="61" height="61" class="card-canvas" id="card-canvas"></canvas>
        </div>
        <div class="side">
            <h3 class="subtitle info">{{$t('Rules')}}</h3>
            <p>{{game.rules}}</p>
            <div class="info-wrap">
                <div class="line">
                    <span class="title">{{$t('Age')}}:</span><span class="value">5-6 years</span>
                </div>
                <div class="line">
                    <span class="title">{{$t('Aim')}}:</span><span class="value">Обучение счету в пределах 12</span>
                </div>
            </div>
            <div class="stat-wrap">
                <div class="line">
                    <span class="views-count">{{this.views}}</span>
                </div>
                <div class="line">
                    <span class="comments-count">{{this.comments}}</span>
                </div>
            </div>
            <div class="btn-wrap">
                <a class="btn main">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.00011 10C9.01047 9.20758 9.32986 8.45052 9.89024 7.89014C10.4506 7.32976 11.2077 7.01037 12.0001 7.00001C12.7925 7.01037 13.5496 7.32976 14.11 7.89014C14.6704 8.45052 14.9897 9.20758 15.0001 10C14.9897 10.7924 14.6704 11.5495 14.11 12.1099C13.5496 12.6703 12.7925 12.9896 12.0001 13C11.2077 12.9896 10.4506 12.6703 9.89024 12.1099C9.32986 11.5495 9.01047 10.7924 9.00011 10ZM12.0001 19L16.0001 20V16.92C14.7938 17.6465 13.4081 18.0206 12.0001 18C10.5921 18.0206 9.20643 17.6465 8.00011 16.92V20M12.0001 4.00001C11.2121 3.98563 10.4294 4.13257 9.70027 4.4318C8.97112 4.73102 8.31087 5.17622 7.76011 5.74001C7.19022 6.29137 6.73988 6.95411 6.4371 7.68698C6.13431 8.41985 5.98557 9.20718 6.00011 10C5.98969 10.7878 6.14044 11.5694 6.4431 12.2968C6.74576 13.0243 7.19394 13.6821 7.76011 14.23C8.3083 14.7992 8.9674 15.25 9.69668 15.5544C10.426 15.8588 11.2099 16.0105 12.0001 16C12.7903 16.0105 13.5743 15.8588 14.3035 15.5544C15.0328 15.25 15.6919 14.7992 16.2401 14.23C16.8063 13.6821 17.2545 13.0243 17.5571 12.2968C17.8598 11.5694 18.0105 10.7878 18.0001 10C18.0146 9.20718 17.8659 8.41985 17.5631 7.68698C17.2603 6.95411 16.81 6.29137 16.2401 5.74001C15.6893 5.17622 15.0291 4.73102 14.2999 4.4318C13.5708 4.13257 12.7881 3.98563 12.0001 4.00001ZM20.0001 10C19.9788 10.9599 19.7858 11.9082 19.4301 12.8C19.1097 13.7074 18.6249 14.5481 18.0001 15.28V23L12.0001 21L6.00011 23V15.28C4.7058 13.8265 3.99361 11.9463 4.00011 10C3.98248 8.95059 4.18014 7.9087 4.58089 6.93865C4.98163 5.96861 5.57696 5.091 6.33011 4.36001C7.06381 3.6001 7.94547 2.99864 8.92067 2.59274C9.89587 2.18683 10.9439 1.98511 12.0001 2.00001C13.0563 1.98511 14.1043 2.18683 15.0795 2.59274C16.0547 2.99864 16.9364 3.6001 17.6701 4.36001C18.4233 5.091 19.0186 5.96861 19.4193 6.93865C19.8201 7.9087 20.0177 8.95059 20.0001 10Z" fill="white"/>
                    </svg>
                    {{$t('Show top')}}
                </a>
            </div>
        </div>
    </div>
    <div class="nav">
        <router-link class="btn" to="/games">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.8501 21.1C17.1001 20.85 17.2251 20.554 17.2251 20.212C17.2251 19.87 17.1001 19.5743 16.8501 19.325L9.5251 12L16.8751 4.65C17.1084 4.41667 17.2251 4.125 17.2251 3.775C17.2251 3.425 17.1001 3.125 16.8501 2.875C16.6001 2.625 16.3041 2.5 15.9621 2.5C15.6201 2.5 15.3244 2.625 15.0751 2.875L6.6751 11.3C6.5751 11.4 6.5041 11.5083 6.4621 11.625C6.4201 11.7417 6.39943 11.8667 6.4001 12C6.4001 12.1333 6.4211 12.2583 6.4631 12.375C6.5051 12.4917 6.57576 12.6 6.6751 12.7L15.1001 21.125C15.3334 21.3583 15.6211 21.475 15.9631 21.475C16.3051 21.475 16.6008 21.35 16.8501 21.1Z" fill="#A6A6A6"/>
            </svg>
            {{$t('To games list')}}
        </router-link>
        <div class="tag-list">
            <span class="tag-item" v-for="tag in this.tags">
                <router-link :to="tag.url">{{tag.title}}</router-link>
            </span>
        </div>
    </div>
    <div class="additional-wrap">
        <div class="description-wrap">
            <h3 class="subtitle">{{$t('Game description')}}</h3>
            <p>{{game.description}}</p>
        </div>
        <div class="games-wrap">
            <h3 class="subtitle">{{$t('Random Game list')}}</h3>
            <div class="games">
                <a  v-for="game in games" :style='{ backgroundImage: `url(${game.thumb})` }' class="game-item"></a>
            </div>
        </div>

        <div class="comments-form-wrap">
            <comment-form
                :title="$t('Left comment')"
                :entity-id="game.id"
                entity-type="game"
            ></comment-form>
        </div>
        <div class="comments-wrap">
            <comment-list
                :entity-id="game.id"
                entity-type="game"
            ></comment-list>
        </div>

    </div>







</template>

<script>

import GameService from "../../services/GameService";
import CommentForm from "../Components/Page/CommentForm.vue";
import CommentList from "../Components/Page/CommentList.vue";
import DataService from "../../services/DataService";

export default {
    name: "Game",
    components: {CommentList, CommentForm},
    props : ["params"],
    data() {
        return {
            game : {title : '', rules : ''},
            width : 0,
            height : 0,
            isLoad : false,
            games : [],
            tags : [],
            views : 0,
            comments : 0
        }
    },
    mounted() {
        this.init();
    },
    methods : {
        init(){

            let gameScript = window.document.createElement('script');
            this.game = this.params.data.page ?? null;
            this.games = this.game.games ?? null;
            this.tags = this.game.tags ?? null;
            this.views = this.game.views ?? null;
            this.comments = this.game.comments ?? null;

            if (this.game.game) {
                this.width = 1024;
                this.height = 700;
                this.language = localStorage.getItem('language');
                this.script = this.game.game;


                this.isLoad = true;
                gameScript.setAttribute('src', this.game.game);
                gameScript.setAttribute('type', 'text/javascript');
                gameScript.setAttribute('async', 'true');
                document.body.appendChild(gameScript);
                this.statistic(this.game.translation_id);

            }


        },
        statistic(id){
            let data = {
                type : 'game',
                id : id
            }
            DataService.post('statistic', data);
        }
    }

}
</script>

<style scoped>

    .game-wrap{
        margin-top: 30px;
        display: flex;
    }

    .subtitle.info{
        padding-left: 42px;
    }

    .subtitle.info:before{
        background-image: url('/assets/img/icons/info.svg');
        top:0px;
        left: 0px;
        width: 32px;
        height: 32px;
    }


    .game{
        width: 1100px;
        height: 750px;
        border: 1px solid #eaeaea;
        margin: 0px;
    }
    .side{
        padding: 15px;
        border: 1px solid #eaeaea;
        margin-left: 36px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        font-size: 17px;
        line-height: 170%;
    }

    .side .info-wrap{
        margin-top:57px;
    }

    .stat-wrap .line, .info-wrap .line{
        margin-bottom: 5px;
    }

    .info-wrap .value{
        margin-left: 5px;
    }

    .views-count, .comments-count{
        position: relative;
        padding-left: 30px;
    }

    .views-count:before, .comments-count:before{
        content: '';
        display: block;
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
    }

    .views-count:before{
        background-image: url('/assets/img/icons/eye.svg');
        top:0px;
        left: 0px;
        width: 24px;
        height: 24px;
    }

    .comments-count:before{
        background-image: url('/assets/img/icons/comments.svg');
        top:0px;
        left: 0px;
        width: 24px;
        height: 24px;
    }

    .additional-wrap{

    }

    .btn-wrap{
        margin-top: 39px;
    }

    .nav{
        margin: 30px 0px 56px;
        align-items: center;
    }
    .tag-list{
        margin-left: 40px;
    }
    .tag-item{
        border: 1px solid #6e41e2;
        border-radius: 10px;
        padding: 5px 15px;
        font-size: 15px;
        color: #222;
        text-decoration: none;
        margin-right: 10px;
    }

    .tag-item a{
        color: #222;
        text-decoration: none;
    }

    .description-wrap{
        margin-bottom: 40px;
    }

    .games-wrap{
        margin-bottom: 80px;
    }

    .games{
        display: flex;
    }

    .games-wrap .game-item{
        width: 340px;
        height: 200px;
        display:block;
        background-size: contain;
        background-repeat: no-repeat;
        margin-right: 20px;
    }

    .comments-wrap{
        margin: 40px 0px;
    }


</style>
