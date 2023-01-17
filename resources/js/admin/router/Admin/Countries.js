import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'countries',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.countries',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.country.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Settings/Country/Edit.vue"),

        },
        {
            name: 'admin.country.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Settings/Country/Edit.vue"),

        }
    ]
}
