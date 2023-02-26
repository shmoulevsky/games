import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'tags',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.tags',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.tag.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/Tag/Edit.vue"),

        },
        {
            name: 'admin.tag.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/Tag/Edit.vue"),

        }
    ]
}
