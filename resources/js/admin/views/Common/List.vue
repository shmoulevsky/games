<template>
	<div class="card card-primary card-outline">
		<div class="card-body">
			<table-admin
				:route_list="url"
				route_create_name="common.create"
				route_edit_name="common.edit"
				:columns="columns"
				:items="items.data"
				:headers="headers"
                @changeItems="updateItems(items)"
			>
			</table-admin>
			<vue-pagination
				:pagination="items"
				@paginate="getItems()"
				:offset="offset"
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

export default {
	data() {
		return {
			title: tableConfig[this.$route.params.entity].title,
			items: tableConfig[this.$route.params.entity].items,
			offset: tableConfig[this.$route.params.entity].offset,
			headers: tableConfig[this.$route.params.entity].headers,
			columns: tableConfig[this.$route.params.entity].columns,
		};
	},
	components: {
		TableAdmin,
		VuePagination,
	},
    computed : {
        url(){
            DataService.url = this.$route.params.entity;
            return DataService.getListUrl(this.offset)
        }
    },
	watch: {
		"$route.params.entity": function () {
			DataService.url = this.$route.params.entity;
			this.getItems();
		},
	},
	methods: {
		getItems() {

			DataService.getList(this.offset, this.items.current_page).then(
				(response) => {
					this.setDefault();
					this.items = response.data ?? [];
				}
			);
		},
		setDefault() {

			this.headers = tableConfig[this.$route.params.entity].headers;
			this.columns = tableConfig[this.$route.params.entity].columns;
		},
        updateItems(items){
            this.items = items;
        }
	},
	mounted() {
        this.$store.dispatch('setTitle', this.title);
		DataService.url = this.$route.params.entity;
		this.getItems();
	},
};
</script>
