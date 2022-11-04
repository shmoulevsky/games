<template>
    <div>
        <admin-form
            :id="id"
            :url="url"
            :item="item"
            :tabs="tabs"
            @errorEvent="handleError"
        >
        </admin-form>
    </div>
</template>
<script>


import AdminForm from "../Components/Form/Form";
import formConfig from "../../config/FormConfig";
import DataService from "../../services/DataService";
import axiosInstance from "../../services/axios";

export default({
    data() {
       return {
           item : {},
           id : {},
           languages : [
               {"title" : "Russian", "code" : "ru", "id" : 1},
               {"title" : "English", "code" : "en", "id" : 2},
           ]
       }
    },
    computed : {
        url : function() { return this.$route.params.entity},
    },
    components: {
        AdminForm
    },
    methods : {
        getItem(){

            this.item = formConfig[this.$route.params.entity];

            if(this.item.tabs){
                for (let key in this.item.tabs){
                    if(this.item.tabs[key].languages === true){
                        this.item.tabs[key].translations = [];
                        for (let lang in this.languages){

                            this.item.tabs[key].translations.push({
                                active : parseInt(lang) === 0,
                                title : this.languages[lang].title,
                                id : this.languages[lang].id,
                                code : this.languages[lang].code,
                                fields : _.cloneDeep(this.item.tabs[key].fields)
                            });
                        }

                        this.item.tabs[key].fields = null;
                    }

                    this.fillOptions(this.item.tabs[key].fields);
                }
            }else{
                this.fillOptions(this.item.fields);
            }

            this.id = this.$route.params.id ?? null;

            if(!this.id){
                this.item.title = '';
                this.$store.dispatch('setTitle', this.item.title_add);
                return ;
            }

            DataService.url = this.$route.params.entity;
            DataService.getById(this.id).then(response => {

                let info = response.data.data ?? null;
                this.item.title = '#' + this.id;
                this.$store.dispatch('setTitle', this.item.title_edit);

                if(this.item.tabs){
                    for (let key in this.item.tabs){
                        if(this.item.tabs[key].languages === true){
                            for(let trans in this.item.tabs[key].translations){
                                this.fillValues(this.item.tabs[key].translations[trans].fields, info);
                            }
                        }else{
                            this.fillValues(this.item.tabs[key].fields, info);
                        }
                    }
                }else{
                    this.fillValues(this.item.fields, info);
                }

            })
        },
        fillOptions(item){
            for (let key in item) {

                if(item[key].getInfo){

                    let getInfo = new Function(item[key].getInfo.arguments, item[key].getInfo.body);
                    getInfo(axiosInstance, item[key]);
                }
            }
        },
        fillValues(item, info){
            for (let key in info) {
                if(!item[key]) continue;
                item[key].value = info[key];
            }
        },
        handleError(errs){
            for (let key in errs) {
                this.item[key].er = true;
                this.item[key].message = errs[key][0];
            }
            console.log(errs);
        }
    },
    mounted(){
        this.item = null;
        this.getItem();
    }
})
</script>

