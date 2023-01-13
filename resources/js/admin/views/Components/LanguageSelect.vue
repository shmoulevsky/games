<template>
    <select class="form-select" @change="onChange($event)" v-model="currentLanguage">
        <option v-for="language in languages" v-bind:value="language.id" >
            {{language.name}}
        </option>
    </select>
</template>

<script>
export default {
    name: "LanguageSelect",
    data(){
        return {
            currentLanguage : this.$store.getters.getLanguage
        }
    },
    computed: {
        languages() { return this.$store.getters.getLanguages }
    },
    methods : {
      onChange(event){
          this.$store.dispatch('setLanguage', event.target.value)
      }
    },
    created() {

    }

}
</script>

<style scoped>

</style>
