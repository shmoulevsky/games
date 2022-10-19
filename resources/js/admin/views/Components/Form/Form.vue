<template>
	<div class="card card-info">
		<div class="card-header">
			<h3 class="card-title">Добавить элемент</h3>
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
				<div v-else v-for="(field, key) in item" :key="key">
					<admin-fields :field="field"></admin-fields>
				</div>
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-info">Сохранить</button>
				<button type="button" @click="goBack" class="btn btn-danger m-lg-3">
					Отмена
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

			for (let key in this.item) {
				formData.append(key, this.item[key].value);
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
