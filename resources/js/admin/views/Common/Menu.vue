<template>
    <div class="col-5">
        <success-text :is-show="this.success.is_show" :text="this.success.text"></success-text>
        <error-text :text="this.errors"></error-text>
        <div class="tab-content text-justify">
            <div
                class="active show tab-pane fade"
                id="tab-translations"
                role="tabpanel"
                aria-labelledby="tab-list-translations">
                <div class="list-group list-group-horizontal-sm mb-1 text-center col-4 mb-3" role="tablist">
                    <a v-for="(language, key) in languages"
                       :key="'tab-' + key"
                       :class="language.is_active ? 'active' : ''"
                       class="list-group-item list-group-item-action"
                       :id="'tab-list-'+key"
                       data-bs-toggle="list"
                       :href="'#tab-' + key"
                       role="tab">{{language.name}}
                    </a>
                </div>
                <div class="tab-content text-justify">
                    <div v-for="(language, key) in languages"
                         :class="language.is_active ? 'active' : ''"
                         class="show tab-pane fade"
                         :id="'tab-'+key"
                         role="tabpanel"
                         :aria-labelledby="'tab-list-'+key">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <span>{{language.title}}</span>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <button type="button" @click="addMenuItem(language.id)" class="btn btn-primary">{{$t('Add')}}</button>
                                        </li>
                                        <li class="list-group-item" v-for="(item, keySub) in this.items[language.id]">
                                            <div class="input-group mb-3">
                                                <button type="button" @click="addMenuSubItem(language.id, keySub, item)" class="btn btn-primary"><i class="bi bi-plus"></i></button>
                                                <span class="input-group-text">{{$t('Title')}}</span>
                                                <input type="text" class="form-control" v-model="item.title">
                                                <span class="input-group-text">{{$t('Url')}}</span>
                                                <input type="text" class="form-control" v-model="item.url">
                                                <button type="button" @click="removeMenuItem(item, language.id)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </div>
                                            <ul v-if="item.children" class="list-group">
                                                <li class="list-group-item" v-for="child in item.children">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">{{$t('Title')}}</span>
                                                        <input type="text" class="form-control" v-model="child.title">
                                                        <span class="input-group-text">{{$t('Url')}}</span>
                                                        <input type="text" class="form-control" v-model="child.url">
                                                        <button type="button" @click="removeMenuSubItem(child, language.id, keySub)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-3">
                                    <button type="button" @click="sendForm()" class="btn btn-primary">{{$t('Save')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import DataService from "../../services/DataService";
import {mapGetters} from "vuex";
import axiosInstance from "../../services/axios";
import SuccessText from "../Components/Form/SuccessText.vue";
import ErrorText from "../Components/Form/ErrorText.vue";

export default {
    name: "Menu",
    components: {ErrorText, SuccessText},
    data() {
        return {
            title: {},
            items: [],
            success: {
                text : this.$t("Data has been saved"),
                is_show : false
            },
            errors : '',
        };
    },
    computed: {
        ...mapGetters({
            languages: 'getLanguages',
        })
    },
    methods : {
        addMenuItem(key){

            if(this.items[key]){
                this.items[key].push({"title" : "", "url" : ""});
            }else{
                this.items[key] = [];
                this.items[key].push({"title" : "", "url" : ""});
            }

        },
        addMenuSubItem(key, keySub, item){

            if(this.items[key][keySub].children){
                this.items[key][keySub].children.push({"title" : "", "url" : item.url+ '/'});
            }else{
                this.items[key][keySub].children = [];
                this.items[key][keySub].children.push({"title" : "", "url" : item.url+ '/'});

            }

        },
        removeMenuItem(item, key){
            this.items[key].splice(this.items[key].indexOf(item), 1);
        },
        removeMenuSubItem(item, key, keySub){
            this.items[key][keySub].children.splice(this.items[key][keySub].children.indexOf(item), 1);
        },
        fillUrl(item){
            item.url = item.url + item.title;
            console.log(item);
        },
        sendForm() {

            let url = 'admin/settings/key/' + this.type;
            let requestType = 'post';

            axiosInstance({
                method: requestType,
                url : url,
                data : {'json' : this.items}
            })
                .then(response => {
                    this.errors = '';
                    this.success.is_show = true;
                    setTimeout(() =>{this.success.is_show = false;}, 3000);
                })
                .catch(error => {

                    this.errors = '';

                    if(error.response.status === 500){
                        this.errors = error.response.data.message;
                    }else{
                        for(let i in error.response.data.errors){
                            this.errors +=  error.response.data.errors[i] ?? null;
                        }
                    }

                });

        },
        goBack(){
            this.$router.go(-1);
        }
    },
    created() {

        this.type = this.$route.params.type;

        for(let key in this.languages){
            this.items[this.languages[key].id] = [];
        }

        DataService.get('/admin/settings/' + this.type).then(
            (response) => {
                this.items = response.data.data.json ?? [];
            }
        );
    }
}
</script>

<style scoped>

</style>
