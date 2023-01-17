<template>
	<div class="card card-primary card-outline">
		<div class="card-body">
			<table-admin
				:route_create_name="add"
				:route_edit_name="edit"
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
import {camelize} from "../../../common/utils";

export default {
	data() {
		return {
			title: {},
			items: {},
			offset: null,
			headers: {},
			per_page: null,
			sort: null,
			dir: null,
			add: '',
			edit: '',
			current_page: 1,
		};
	},
	components: {
		TableAdmin,
		VuePagination,
	},
    computed : {
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

            let url = window.location.pathname.split("/").pop();
            let table = camelize(url).replace('-','');

            this.title = tableConfig[table].title ?? [];
            this.headers = tableConfig[table].headers ?? [];
            this.offset = tableConfig[table].offset ?? [];
            this.per_page = tableConfig[table].per_page ?? [];
            this.add = tableConfig[table].add ?? [];
            this.edit = tableConfig[table].edit ?? [];
            this.$store.dispatch('setTitle', this.title);

            DataService.url = url;
            this.getItems();


		},
	},
	mounted() {

		DataService.url = this.$route.params.entity;
        this.setDefault();

	},
};
</script>
