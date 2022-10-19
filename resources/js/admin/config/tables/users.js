import { trans } from 'laravel-vue-i18n';

let users = {
    title : trans('User list'),
    items: {
        total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            posts: {
            data: [],
        },
    },
    offset: 5,
        headers: [
    {
        title: "ID",
        code: "id" ,
        dir: "desc",
    },
    {
        title: trans("Created at"),
        code: "created_at",
        dir: "asc",
    },
    {
        title: trans("E-mail"),
        code: "email",
        dir: "asc",
    },
    {
        title: trans("Name"),
        code: "name",
        dir: "asc",
    },
    {
        title: trans("Last name"),
        code: "lastname",
        dir: "asc",
    },
],
    columns: ["id","created_at", "email", "name", "lastname"],
}

export default users;
