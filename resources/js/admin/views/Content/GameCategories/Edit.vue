<template>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{item.title || ''}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <success-text :is-show="this.success.is_show" :text="this.success.text"></success-text>
        <error-text :text="this.errors"></error-text>
        <form @submit.prevent="sendForm" class="form-horizontal">
            <div class="card-body col-12">
                <div class="list-group list-group-horizontal-sm mb-1 text-center col-8 mb-3" role="tablist">
                    <a v-for="(tab, key) in tabs"
                       :key="'tab-' + key"
                       :class="tab.active ? 'active' : ''"
                       class="list-group-item list-group-item-action"
                       :id="'tab-list-'+key"
                       data-bs-toggle="list"
                       :href="'#tab-' + key"
                       role="tab">{{tab.title}}
                    </a>
                </div>
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
                            <a data-bs-toggle="modal" data-bs-target="#translate" style="margin-left: 10px" class="btn btn-outline-primary"><i class="bi bi-pen-fill"></i></a>
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
                                        <text-input
                                            :field="fields.title"
                                            @update:modelValue="item.translations[language.id].title = $event"
                                            :modelValue="item.translations[language.id].title"
                                        />
                                        <text-input
                                            :field="fields.sort"
                                            @update:modelValue="item.translations[language.id].sort = $event"
                                            :modelValue="item.translations[language.id].sort"
                                        />

                                        <select-list
                                            :field="fields.is_active"
                                            @update:modelValue="item.translations[language.id].is_active = $event"
                                            :modelValue="item.translations[language.id].is_active"
                                        />

                                        <text-area
                                            :field="fields.description"
                                            @update:modelValue="item.translations[language.id].description = $event"
                                            :modelValue="item.translations[language.id].description"
                                        />
                                    </div>
                                    <div class="col">
                                        <text-input
                                            :field="fields.seo_title"
                                            @update:modelValue="item.translations[language.id].seo_title = $event"
                                            :modelValue="item.translations[language.id].seo_title"
                                        />
                                        <text-input
                                            :field="fields.seo_keywords"
                                            @update:modelValue="item.translations[language.id].seo_keywords = $event"
                                            :modelValue="item.translations[language.id].seo_keywords"
                                        />
                                        <text-area
                                            :field="fields.seo_description"
                                            @update:modelValue="item.translations[language.id].seo_description = $event"
                                            :modelValue="item.translations[language.id].seo_description"
                                        />
                                        <text-input
                                            :field="fields.seo_url"
                                            @update:modelValue="item.translations[language.id].seo_url = $event"
                                            :modelValue="item.translations[language.id].seo_url"
                                        />
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div
                        class="show tab-pane fade"
                        id="tab-common"
                        role="tabpanel"
                        aria-labelledby="tab-list-common">
                        <div class="form-group">
                            <select-list
                                :field="fields.parent_category"
                                @update:modelValue="item.parent_id = $event"
                                :modelValue="item.parent_id"
                            />
                        </div>
                        <div class="form-group">
                            <file-input-image
                                @update:modelValue="item.thumb = $event"
                                :width="100"
                                :modelValue="item.thumb"
                            />
                        </div>


                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">{{$t('Save')}}</button>
                <button type="button" @click="goBack" class="btn btn-danger m-lg-3">
                    {{$t('Cancel')}}
                </button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <translate-form-fields
        :languages="this.languages"
        :translations="this.item.translations"
        :fields="['title','description','seo_title','seo_description','seo_keywords','seo_url']"
    />
</template>
<script>


import LangTab from "../../Components/Form/LangTab.vue";
import Tab from "../../Components/Form/Tab.vue";
import TextInput from "../../Components/Form/Elements/TextInput.vue";
import DataService from "../../../services/DataService";
import axiosInstance from "../../../services/axios";
import TextArea from "../../Components/Form/Elements/TextArea.vue";
import {mapGetters} from "vuex";
import ErrorText from "../../Components/Form/ErrorText.vue";
import FileInputImage from "../../Components/Form/Elements/FileInputImage.vue";
import FileInputDocument from "../../Components/Form/Elements/FileInputDocument.vue";
import SelectList from "../../Components/Form/Elements/SelectList.vue";
import SuccessText from "../../Components/Form/SuccessText.vue";
import TranslateFormFields from "../../Components/Form/TranslateFormFields.vue";


export default {
    name: "Edit",
    components: {
        TranslateFormFields,
        SuccessText,
        SelectList, FileInputDocument, FileInputImage, ErrorText, TextArea, TextInput, Tab, LangTab},
    data() {
        return {
            url: 'game-categories',
            errors: '',
            success: {
                    text : this.$t("Data has been saved"),
                    is_show : false
            },
            id: null,
            item: {
                id : null,
                title : '',
                translations : []
            },
            categories : []
        };
    },
    computed: {
        ...mapGetters({
            languages: 'getLanguages',
            language: 'getLanguage'
        }),
        tabs(){
            return {
                translations : {title : this.$t("Main settings"), active : true},
                common : {title : this.$t("Common settings"), active : false},
            }
        },
        fields(){

            return {
                title: {title : this.$t("Title"), er : "", message : ""},
                sort: {title : this.$t("Sort"), er : "", message : ""},
                description: {title : this.$t("Description"), er : "", message : ""},
                parent_category: {title : this.$t("Parent category"), er : "", message : "", options : this.categories},
                is_active: {title : this.$t("Is active"), er : "", message : "", options : [{text : this.$t("Yes"), value : 1}, {text : this.$t("No"), value : 0}]},
                seo_title: {title : this.$t("SEO title"), er : "", message : ""},
                seo_description: {title : this.$t("SEO description"), er : "", message : ""},
                seo_keywords: {title : this.$t("SEO keywords"), er : "", message : ""},
                seo_url: {title : this.$t("Url"), er : "", message : ""},
            }

        }
    },
    methods: {
        prepareItem(){

            this.id = this.$route.params.id;
            this.is_copy = this.$route.params.is_copy;

            let translations = [];

            DataService.url = this.url;


            for(let key in this.languages){
                translations[this.languages[key].id] = this.getEmptyTranslation();
            }

            this.item.translations = translations;
            this.$store.dispatch('setTitle', 'Add');

            if(!this.id) return;

            DataService.getById(this.id).then(
                (response) => {
                    this.item = response.data.data ?? [];
                    this.$store.dispatch('setTitle', this.item.translations[this.language].title ?? 'New');

                    for(let key in this.languages) {
                        if(typeof(this.item.translations[this.languages[key].id]) === 'undefined' ){
                            this.item.translations[this.languages[key].id] = this.getEmptyTranslation();
                        }
                    }
                }
            );

            DataService.url = 'game-categories/select';
            DataService.getList().then((response) => {
                this.categories = response.data.data ?? [];
            });

        },
        getEmptyTranslation(){
           return{
                id : null,
                title : '',
                description : '',
                rules : '',
                seo_title : '',
                seo_keywords : '',
                seo_description : '',
                seo_url : '',
                sort : '100',
                is_active : true,
            }
        },
        sendForm() {

            let url = 'admin/' + this.url;
            let requestType = 'post';

            if(this.id){
                url += '/' +this.id;
                requestType = 'patch';
            }

            axiosInstance({
                method: requestType,
                url : url,
                data : this.item
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
        this.prepareItem();
    },
    mounted() {

    }

};
</script>
