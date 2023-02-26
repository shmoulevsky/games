import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'properties',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.propertys',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.property.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/Property/Edit.vue"),

        },
        {
            name: 'admin.property.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/Property/Edit.vue"),

        }
    ]
}
