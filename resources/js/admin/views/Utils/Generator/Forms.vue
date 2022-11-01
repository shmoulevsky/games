<template>
    <div v-if="isFirstStep" class="card">
        <div class="card-header">
            <h4 class="card-title">{{$t('Tables list')}}</h4>
        </div>
        <div class="card-content">
            <div class="card-body col-5">
                <p>

                </p>
                <ul class="list-group">
                    <li v-for="(table, index) in tables" class="list-group-item">
                        <div class="form-check">
                            <input
                                v-model="tableName"
                                class="form-check-input"
                                name="tables[]" :id="'table'+index"
                                type="radio"
                                aria-label="..."
                                :key="'table-name'+index"
                                :value="table"
                            >
                            <label class="ml-1" :for="'table'+index">{{table}}</label>
                        </div>
                    </li>
                </ul>
                <button @click="showTable" class="btn btn-primary block mt-3">{{$t('Next')}}</button>
            </div>
        </div>
    </div>
    <div v-else class="card">
        <div class="card-header">
            <h4 class="card-title">{{$t('Tables list')}}</h4>
        </div>
        <div class="card-content">
            <div class="row">
                <div @drop="onDrop($event, 2)"
                     @dragover.prevent
                     @dragenter.prevent
                     class="card-body col-5">
                <div v-if="tabs">
                    <div class="list-group list-group-horizontal-sm mb-1 text-center col-4 mb-3" role="tablist">
                        <a v-for="(tab, key) in tabs"
                           :key="'tab' + key"
                           :class="tab.active ? 'active' : ''"
                           class="list-group-item list-group-item-action"
                           :id="'tab-list'+key"
                           data-bs-toggle="list"
                           :href="'#tab' + key"
                           role="tab">{{tab.title}}
                        </a>
                    </div>
                    <div class="tab-content text-justify">
                        <div v-for="(tab, key) in tabs"
                             :key="'tab-wrap' + key"
                             :class="tab.active ? 'active show' : ''"
                             :id="'tab'+key"
                             class="tab-pane fade"
                             role="tabpanel"
                             :aria-labelledby="'tab-list'+key">
                            <div v-for="(field, key) in tab.fields" :key="key">
                                <admin-fields :field="field"></admin-fields>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="card-body col-5"
                     @drop="onDrop($event, 1)"
                     @dragover.prevent
                     @dragenter.prevent>
                    <a v-for="(field, key) in fields"
                       :key="key" href="#"
                       @click="chooseField(field)"
                       :class="field.is_choosen === true ? 'btn-outline-primary' : 'btn-primary'"
                       class="btn m-lg-1">{{field.title}}</a>
                </div>
                <div class="card-body">
                <div class="mt-3">
                    <button @click="save" class="btn btn-primary block">{{$t('Save')}}</button>
                    <button @click="back" class="btn btn-info block m-lg-3">{{$t('Back')}}</button>

                </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>

import axiosInstance from "../../../services/axios";
import AdminFields from "../../Components/Form/Fields";

export default {
    components: {AdminFields},
    name: "TablesList",
    computed: {
        target() {
            return this.fields.filter((item) => item.list === 1)
        }
    },
    data(){
        return {
            tables : {},
            columns : {},
            tabs : [
                    {
                        title : "New",
                        active : true,
                        fields: {}
                    }
            ],
            checkedFields : [],
            isFirstStep : true,
            tableName : null,
        }
    },
    mounted() {
        this.getTables();
    },
    methods : {
        getTables(){
            axiosInstance.get('admin/generator/tables').then((response) => {
                this.tables = response.data.tables;
            })
        },
        showTable(){
            axiosInstance.get('admin/generator/table/' + this.tableName).then((response) => {
                this.fields = response.data.fields;
                this.isFirstStep = false;
            })
        },
        chooseField(field){
            field.is_choosen = !field.is_choosen;
        },
        startDrag(event, item) {
            event.dataTransfer.dropEffect = 'move'
            event.dataTransfer.effectAllowed = 'move'
            event.dataTransfer.setData('field', item.Field)
        },
        onDrop(event, list) {

            const field = event.dataTransfer.getData('field')
            const item = this.columns.find((item) => item.Field === field)
            item.list = list;
            console.log(list);
            console.log(item);
        },
        save(){

            let data = {
                table : this.tableName,
                columns : this.checkedFields
            };

            axiosInstance.post('admin/generator/list-handle', data).then((response) => {
                this.checkedFields = [];
                this.isFirstStep = true;
            })
        },
        back(){
            this.checkedFields = [];
            this.isFirstStep = true;
        }
    }
}
</script>

<style scoped>

</style>
