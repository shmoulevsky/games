import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'languages',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.languages',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.language.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Settings/Language/Edit.vue"),

        },
        {
            name: 'admin.language.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Settings/Language/Edit.vue"),

        }
    ]
}
