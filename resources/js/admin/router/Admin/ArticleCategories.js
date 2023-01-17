import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'article-categories',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.article-categories',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.article-categories.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Content/ArticleCategories/Edit.vue"),

        },
        {
            name: 'admin.article-categories.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Content/ArticleCategories/Edit.vue"),

        }
    ]
}
