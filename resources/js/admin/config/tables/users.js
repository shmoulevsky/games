import { trans } from 'laravel-vue-i18n';

let users = {
    title : trans('User list'),
    per_page: 2,
    items: {},
    headers: [
    {
        title: "ID",
        code: "id" ,
        dir: "desc",
        is_sort: true,
    },
    {
        title: trans("Created at"),
        code: "created_at",
        dir: "asc",
        is_sort: false,
    },
    {
        title: trans("E-mail"),
        code: "email",
        dir: "asc",
        is_sort: false,
    },
    {
        title: trans("Name"),
        code: "name",
        dir: "asc",
        is_sort: false,
    },
    {
        title: trans("Last name"),
        code: "lastname",
        dir: "asc",
        is_sort: false,
    },
],
    columns: ["id","created_at", "email", "name", "lastname"],
}

export default users;
