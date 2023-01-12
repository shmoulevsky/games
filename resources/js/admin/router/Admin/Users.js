import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'users',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.users',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.user.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Users/Edit.vue"),

        },
        {
            name: 'admin.user.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Users/Edit.vue"),

        }
    ]
}
