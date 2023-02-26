<template>
    <h3 class="subtitle">{{$t('Comments list')}}</h3>
    <div v-if="comments" class="comments">
        <div  v-for="comment in comments" class="comment">
            <div class="author">
                <img :src="comment.photo" alt="" srcset="">
                <span>{{comment.name}}</span>
            </div>
            <div class="info">
                <svg
                    width="22.09506"
                    height="22.767048"
                    viewBox="0 0 5.8459844 6.0237813"
                    version="1.1"
                    id="svg5"
                    xml:space="preserve"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:svg="http://www.w3.org/2000/svg"><defs
                     id="defs2" /><g
                                    id="layer1"
                                    transform="translate(-16.568049,-89.294984)"><g
                       id="g2674"><path
                         style="fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.05833;stroke-linecap:round"
                         d="m 22.414034,89.466659 -0.02342,5.839235 -5.174571,-5.872431 z"
                         id="path353" /><path
                    style="fill:none;fill-opacity:1;stroke:#ccc;stroke-width:0.264583;stroke-linecap:round;stroke-dasharray:none;stroke-opacity:1"
                    d="m 22.237081,89.427275 -5.368545,0.01815 5.28051,5.741048"
                    id="path2670" /></g></g></svg>
                <span class="date">{{comment.date}}, {{comment.time}}</span>
                <span>{{comment.comment}}</span>
            </div>
        </div>
    </div>
    <div v-else>
        <p>{{$t('There is no comments')}}</p>
    </div>
</template>

<script>
import DataService from "../../../services/DataService";

export default {
    name: "CommentList",
    props: ['entityId', 'entityType'],
    data() {
        return {
            comments : []
        }
    },
    mounted() {

        setTimeout(() => {
            DataService.get('comments/' + this.entityType + '/' + this.entityId).then((response) => {
                this.comments = response.data.data;
            })
        }, 200);

    }
}
</script>

<style scoped>
.comment{
    display: flex;
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 17px;
    line-height: 170%;
    margin-bottom: 30px;
}

.author{
    width: 200px;
    text-align: center;
    margin-right: 10px;
    align-items: center;
    justify-content: center;
}

.author img{
    max-width: 100px;
    border-radius: 10px;
}

.author span{
    display: block;
}

.info{
    border:1px solid #ccc;
    max-width: 900px;
    padding: 20px;
    border-radius: 10px;
    position: relative;
}

.date{
    display: block;
    font-family: 'Montserrat';
    color: #a6a6a6;
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    margin-bottom: 0px;
}

.info svg{
    position: absolute;
    left: -22px;
    top:20px;
}

</style>
