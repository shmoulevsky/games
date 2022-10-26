<template>
	<div class="card card-primary card-outline">
		<div class="card-body">
			<table-admin
				route_create_name="common.create"
				route_edit_name="common.edit"
				:columns="columns"
				:items="items.data"
				:headers="headers"
                @updateItems="getItems"
			>
			</table-admin>
			<vue-pagination
				:pagination="items.meta ?? {}"
				@paginate="getItems"
				:offset="per_page"
			>
			</vue-pagination>
		</div>
	</div>
</template>

<script>
import DataService from "../../services/DataService";
import TableAdmin from "../Components/Table/TableAdmin";
import VuePagination from "../Components/Table/Pagination";
import tableConfig from "../../config/TableConfig";
import axiosInstance from "../../services/axios";

export default {
	data() {
		return {
			title: {},
			items: {},
			offset: null,
			headers: {},
			columns: {},
			per_page: null,
			sort: null,
			dir: null,
			current_page: 1,
		};
	},
	components: {
		TableAdmin,
		VuePagination,
	},
    computed : {
    },
	watch: {
		"$route.params.entity": function () {
			DataService.url = this.$route.params.entity;
			this.getItems();
		},
	},
	methods: {
		getItems(page, sort, dir) {

            if (sort) this.sort = sort;
            if (dir) this.dir = dir;

			DataService.getList(this.per_page, page, this.sort, this.dir, '').then(
				(response) => {
					//this.setDefault();
					this.items = response.data ?? [];

                    const url = new URL(window.location.href);
                    url.searchParams.delete('page');
                    if(page > 1){
                        url.searchParams.set('page', page);
                    }

                    window.history.replaceState(null, null, url); // or pushState

				}
			);
		},
		setDefault() {

            let table = this.$route.params.entity;

            axiosInstance.get('/admin/generator/info/list/' + table).then((response) => {
                this.title = response.data.list.title ?? [];
                this.headers = response.data.list.headers ?? [];
                this.columns = response.data.list.columns ?? [];
                this.offset = response.data.list.offset ?? [];
                this.per_page = response.data.list.per_page ?? [];

                this.$store.dispatch('setTitle', this.title);

                this.getItems();
            })

		},
	},
	mounted() {

		DataService.url = this.$route.params.entity;
        this.setDefault();

	},
};
</script>
