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
                    <tab :tabs="item.tabs">
                        <template v-slot:tabContent="{ tab }">
                            <template v-if="tab.languages">
                                <lang-tab :tabs="tab.translations" :items="tab.translations">
                                    <template v-slot:tabContent="{ content }">
                                    <div v-for="(field, key) in content.fields" :key="key">
                                        <admin-fields :field="field"></admin-fields>
                                    </div>
                                    </template>
                                </lang-tab>
                            </template>
                            <template v-else>
                                <div v-for="(field, key) in tab.fields" :key="key">
                                    <admin-fields :field="field"></admin-fields>
                                </div>
                            </template>
                        </template>
                    </tab>
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
import Tab from "./Tab";
import LangTab from "./LangTab";
import FormConverter from "./FormConverter";

export default {
	name: "AdminForm",
    components: {AdminFields, Tab, LangTab},

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

            let url = '/admin/' + this.url;
            let requestType = 'post';

            let converter = new FormConverter();
            let fields = converter.convert(this.item);

            fields.id = null;

            if(this.id){
                fields.id = this.id;
                url += '/' +this.id;
                requestType = 'patch';
            }

            axios({
                method: requestType,
                url : url,
                data : fields
            })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
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
