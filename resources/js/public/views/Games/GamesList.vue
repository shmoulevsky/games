<template>
    <h1>Games List</h1>
    <div>Text here...</div>
</template>

<script>
import DataService from "../../services/DataService";

export default {
    name: "GamesList",
    data(){
        return {
            games : {}
        }
    },
    mounted() {
        DataService.getList('games', 10, 1, 'id', 'desc').then(
            (response) => {
                this.games = response.data;
            }
        )
    }
}
</script>

<style scoped>

</style>
