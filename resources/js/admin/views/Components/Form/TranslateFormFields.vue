<template>
    <modal id="translate" :title="$t('Copy languages')" :btn="$t('Translate')"  @action="translate">
        <div>
            <div class="mb-3">
                <select v-model="sourceLanguage"  class="form-select" aria-label="select lang" >
                    <option :key="'s'+language.id" v-for="language in sourceLanguages" :value="language" >{{language.name}}</option>
                </select>
            </div>
            <div>
                <div v-for="language in targetLanguages" :key="'t'+language.id"  class="form-check">
                    <input class="form-check-input" v-model="language.checked" type="checkbox" :id="'check-lang'+language.id">
                    <label class="form-check-label" :for="'check-lang'+language.id">
                        {{language.name}}
                    </label>
                </div>
            </div>

        </div>
    </modal>
</template>

<script>
import Modal from "../Modal.vue";
import DataService from "../../../services/DataService";

export default {
    name: "TranslateFormFields",
    data(){
      return {
          targetLanguages: [],
          sourceLanguages: [],
          sourceLanguage: null,
          checkedTargetLanguages: [],
      }
    },
    components: {Modal},
    props: ["languages", "translations", "fields"],
    mounted() {

        this.sourceLanguage = this.languages[1];

        for(let key in this.languages){
            this.sourceLanguages.push({'id' : this.languages[key].id, 'name' : this.languages[key].name, 'code' : this.languages[key].code});
            this.targetLanguages.push({'id' : this.languages[key].id, 'name' : this.languages[key].name,'code' : this.languages[key].code, checked : true});
        }
    },
    methods : {
        translate(){

            let source = [];
            let type = 'yandex';

            let languagesTo = this.targetLanguages.filter((item) => {return item.checked === true});


            for(let key in this.translations[this.sourceLanguage.id]){

                if(!this.fields.includes(key)) continue;
                source.push({key : key, text : this.translations[this.sourceLanguage.id][key]});
            }


            for(let index in languagesTo){

                let data = {
                    source,
                    language : languagesTo[index].code,
                    type
                }

                DataService.post('/admin/translate', data).then(

                    (response) => {

                        let result = response.data.result;

                        for(let key in this.translations[languagesTo[index].id]){
                            if(!this.fields.includes(key)) continue;
                            this.translations[languagesTo[index].id][key] =  result.find((item) => { return item.key === key}).text ?? '---';
                        }
                    }
                );
            }



        },
    }
}
</script>

<style scoped>

</style>
