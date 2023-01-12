<template>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{item.title || ''}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form @submit.prevent="sendForm" class="form-horizontal">
            <div class="card-body col-5">
                <div class="list-group list-group-horizontal-sm mb-1 text-center col-4 mb-3" role="tablist">
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
                               :class="language.active ? 'active' : ''"
                               class="list-group-item list-group-item-action"
                               :id="'tab-list-'+key"
                               data-bs-toggle="list"
                               :href="'#tab-' + key"
                               role="tab">{{language.title}}
                            </a>
                        </div>
                        <div class="tab-content text-justify">
                            <div v-for="(language, key) in languages"
                                :class="language.active ? 'active' : ''"
                                class="show tab-pane fade"
                                :id="'tab-'+key"
                                role="tabpanel"
                                :aria-labelledby="'tab-list-'+key">
                                <text-input
                                    :field="title"
                                    @update:modelValue="item.translations[language.id].title = $event"
                                    :modelValue="item.translations[language.id].title"
                                />
                                <text-area
                                    :field="description"
                                    @update:modelValue="item.translations[language.id].description = $event"
                                    :modelValue="item.translations[language.id].description"
                                />
                            </div>
                        </div>


                    </div>
                    <div
                        class="show tab-pane fade"
                        id="tab-common"
                        role="tabpanel"
                        aria-labelledby="tab-list-common">
                        <div class="form-group">
                            <file-input
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
</template>
<script>


import LangTab from "../Components/Form/LangTab.vue";
import Tab from "../Components/Form/Tab.vue";
import TextInput from "../Components/Form/Elements/TextInput.vue";
import DataService from "../../services/DataService";
import axiosInstance from "../../services/axios";
import TextArea from "../Components/Form/Elements/TextArea.vue";
import $ from 'jquery';
import FileInput from "../Components/Form/Elements/FileInput.vue";

export default {
    name: "Edit",
    components: {FileInput, TextArea, TextInput, Tab, LangTab},

    data() {
        return {
            form: [],
            url: 'games',
            id: null,
            item: {
                title : '',
                translations : []
            },
            title: {title : "Title",er : "", message : ""},
            description: {title : "Description", er : "", message : ""},
            languages : [
                {"title" : "Russian", "code" : "ru", "id" : 1, "active" : true},
                {"title" : "English", "code" : "en", "id" : 2, "active" : false},
            ],
            tabs: {
                translations : {title : "Main", active : true},
                common : {title : "Common", active : false},
            }
        };
    },
    methods: {
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

                })
                .catch(error => {
                    this.errs = error.response.data.errors ?? null;
                });

        },
        goBack(){
            this.$router.go(-1);
        }
    },
    beforeMount() {

        this.id = this.$route.params.id;
        let translations = [];

        DataService.url = this.url;


        for(let key in this.languages){
            translations[this.languages[key].id] = {title : ''};
        }

        this.item.translations = translations;

        DataService.getById(this.id).then(
            (response) => {
                this.item = response.data.data ?? [];
            }
        );

    },

};
</script>
