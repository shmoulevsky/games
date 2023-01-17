import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'pages',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.pages',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.page.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/Page/Edit.vue"),

        },
        {
            name: 'admin.page.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/Page/Edit.vue"),

        }
    ]
}
