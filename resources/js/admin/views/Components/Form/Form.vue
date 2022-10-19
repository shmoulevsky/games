<template>
	<div class="card card-info">
		<div class="card-header">
			<h3 class="card-title">{{item.title}}</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form @submit.prevent="sendForm" class="form-horizontal">
			<div class="card-body col-5">
                <div v-if="item.tabs">
                    <div class="list-group list-group-horizontal-sm mb-1 text-center col-4 mb-3" role="tablist">
                        <a v-for="(tab, key) in item.tabs"
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
                        <div v-for="(tab, key) in item.tabs"
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
				<div v-else v-for="(field, key) in item.fields" :key="key">
					<admin-fields :field="field"></admin-fields>
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
import axios from "../../../services/axios";
import AdminFields from "./Fields";

export default {
	name: "AdminForm",
    components: {AdminFields},

    data() {
		return {
			form: [],
		};
	},
	methods: {
		filterFields: function () {},
		sendForm() {
			let formData = new FormData();
            let isError = false;

            if(this.item.tabs){
                for (let key in this.item.tabs) {
                    for (let keyField in this.item.tabs[key].fields) {
                        formData.append(keyField, this.item.fields[keyField].value);
                    }
                }
            }else{
                for (let key in this.item.fields) {

                    if(!this.item.fields[key].value){
                        this.item.fields[key].er = true;
                    }

                    formData.append(key, this.item.fields[key].value);
                }
            }

            let url = '/admin/' + this.url;
            let requestType = 'post';

            if(this.id){
                formData.append('id', this.id);
                url += '/' +this.id;
                requestType = 'patch';
            }

			axios({
                    method: requestType,
                    url,
                    data: formData,
                })
				.then(function (response) {
					console.log(response);
				})
				.catch((error) => {
					let errs = error.response.data.errors ?? null;
                    this.$emit('errorEvent', errs);
				});
		},
        goBack(){
            this.$router.go(-1);
        }
	},
	props: ["item", "url","id"],
	mounted() {
    },

};
</script>
