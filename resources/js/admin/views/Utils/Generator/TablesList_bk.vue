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
            <div class="card-body col-5">
                <p>

                </p>
                <ul class="list-group">
                    <li v-for="(column, index) in this.columns" class="list-group-item">
                        <div class="form-group">
                            <input
                                class="form-control"
                                type="text"
                                :name="column.Field"
                                :id="column.Field"
                                :key="column.Field+index"
                                :value="column.name"
                            >
                            <div class="form-check mt-1">
                                <input
                                    class="form-check-input form-check-primary form-check-glow"
                                    type="checkbox"
                                    :name="column.Field + '-show'"
                                    :id="column.Field + '-show'"
                                    :key="column.Field+index+ '-show'"
                                    :value="{'code' : column.Field,'title' : column.name}"
                                    v-model="checkedFields"
                                >
                                <label class="form-check-label" :for="column.Field + '-show'">{{$t('is show')}}</label>
                            </div>
                        </div>


                    </li>
                </ul>
                <div class="mt-3">

                    <button @click="save" class="btn btn-primary block">{{$t('Save')}}</button>
                    <button @click="back" class="btn btn-info block m-lg-3">{{$t('Back')}}</button>

                </div>


            </div>
        </div>
    </div>
</template>

<script>

import axiosInstance from "../../../services/axios";

export default {
    name: "TablesList",
    data(){
        return {
            tables : {},
            columns : {},
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
                this.columns = response.data.columns;

                this.columns.map((item) => {
                   item.name = item.Field.charAt(0).toUpperCase() + item.Field.slice(1);
                   item.name = item.name.replace('_',' ');
                   return  item;
                });

                this.isFirstStep = false;
            })
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
