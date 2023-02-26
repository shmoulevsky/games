<template>
    <div><span>{{$t('Enter with')}} </span></div>
    <a v-for="oauthItem in oauth" :href="oauthItem.link"><img class="oauth-icon" :src="oauthItem.src" /></a>
</template>

<script>
import DataService from "../../services/DataService";

export default {
    name: "OAuthLinks",
    data() {
        return {
            oauth : []
        }
    },
    mounted() {
        DataService.post('oauth/link', {}).then((response) => {
            this.oauth = response.data.links;
        })
    },
}
</script>

<style scoped>
.oauth-icon{
    width: 32px;
    height: auto;
    margin: 8px 8px 0px 0px;
}
</style>
