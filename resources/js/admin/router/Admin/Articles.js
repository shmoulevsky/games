import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'articles',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.articles',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.article.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/Article/Edit.vue"),

        },
        {
            name: 'admin.article.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/Article/Edit.vue"),

        }
    ]
}
