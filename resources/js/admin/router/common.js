import List from "../views/Common/List";
import Form from "../views/Common/Form";

const commonRoutes = [
    {
        meta: {
            title: 'Список',
            auth: true,
        },
        path: "/admin/common/:entity",
        name: "common.list",
        component: List,
    },
    {
        meta: {
            title: 'Новый',
            auth: true,
        },
        path: "/admin/common/:entity/create",
        name: "common.create",
        component: Form,
    },
    {
        meta: {
            title: 'Редактирование',
            auth: true,
        },
        path: "/admin/common/:entity/:id",
        name: "common.edit",
        component: Form,
    },
];

export default commonRoutes;
