<template>
    <div>
        <div>
            <router-link :to="{ name: route_create_name, params: {}}" class="btn btn-success mb-3">{{$t('Add')}}</router-link>
        </div>
    <table class="styled-table">
        <tr>
            <td :data-code="head.code" :data-dir="head.dir" @click="sortColumn" v-for="head in headers" :key="head.title">{{head.title}}</td>
            <td>{{$t('Actions')}}</td>
        </tr>
        <tr v-for="item in items" :key="item.id">
            <td v-for="(column, index) in columns" :key="index">
                {{item[column]}}
            </td>
            <td>
                <router-link class="btn icon icon-left btn-primary m-lg-2" :to="{ name: route_edit_name, params: { 'id' : item.id }}"><i data-feather="edit"></i>{{$t('Edit')}}</router-link>
                <router-link class="btn icon icon-left btn-danger" :to="{ name: route_edit_name, params: { 'id' : item.id }}"><i data-feather="alert-circle"></i>{{$t('Delete')}}</router-link>
            </td>
        </tr>
    </table>
    </div>
</template>
<script>

import axiosInstance from "../../../services/axios";

export default({
    name: 'Table',
    data() {
       return {

       }
    },
    methods: {
        filterFields: function(obj = []) {

             Object.keys(obj).filter(item => this.columns.includes(item) === false).forEach(key => delete obj[key]);
             return obj;

        },
        sortColumn: function (event) {
            let code = event.target.dataset.code;
            let dir = event.target.dataset.dir;
            let url = this.route_list + '&sort=' + code + '&dir=' + dir;
            axiosInstance.get(url).then(
                (response) => {
                    this.$emit('changeItems', response.data ?? []);
                }
            )
        }
    },
    props : ['headers','items','columns','route_list','route_create_name','route_edit_name'],
    mounted(){

    }
})
</script>
<style scoped>
    .styled-table{
        width: 100%;
        border-collapse: collapse;
    }

    .styled-table td{
       padding: 5px 10px;
       border: 1px solid #ccc;
    }
</style>
