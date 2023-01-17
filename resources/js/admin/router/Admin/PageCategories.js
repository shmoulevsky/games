import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'page-categories',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.page-categories',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.page-categories.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/PageCategories/Edit.vue"),

        },
        {
            name: 'admin.page-categories.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/PageCategories/Edit.vue"),

        }
    ]
}
