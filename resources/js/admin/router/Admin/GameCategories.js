import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'game-categories',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.game-categories',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.game-categories.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/GameCategories/Edit.vue"),

        },
        {
            name: 'admin.game-categories.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/GameCategories/Edit.vue"),

        }
    ]
}
