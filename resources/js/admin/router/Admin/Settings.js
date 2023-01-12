import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'settings',
    name: 'settings',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'filemanager',
            path: 'filemanager',
            props: true,
            component: () => import("../../views/Filemanager/Filemanager.vue"),
        }
    ]
}
