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
                    this.fillFields(this.item.tabs[key].fields);
                }
            }else{
                this.fillFields(this.item);
            }

            this.id = this.$route.params.id ?? null;

            if(!this.id){
                return ;
            }

            DataService.url = this.$route.params.entity;
            DataService.getById(this.id).then(response => {

                let info = response.data.data ?? null;

                for (let key in info) {

                    if(!this.item[key]) continue;
                    this.item[key].value = info[key];
                }

            })
        },
        fillFields(item){
            for (let key in item) {

                if(item[key].getInfo){

                    let getInfo = new Function(item[key].getInfo.arguments, item[key].getInfo.body);
                    getInfo(axiosInstance, item[key]);
                }
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

