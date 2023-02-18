<template>

</template>

<script>
import {readUrlHash} from "../../../common/utils";
import DataService from "../../services/DataService";

export default {
    name: "OAuth",
    mounted() {

        if(!window.location.hash) {

        }

        let info = readUrlHash(window.location.hash);
        let params = {
            'access_token' : info.access_token,
            'type' : this.$route.params.type
        }

        DataService.post('oauth/login', params).then((response)=>{

            let access_token = response.data.access_token;
            let user = response.data.user;

            this.$store.dispatch('auth', {access_token, user}).catch(error => {
                this.errors = error;
            })
        })

    }
}
</script>

<style scoped>

</style>
