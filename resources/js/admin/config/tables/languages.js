import { trans } from 'laravel-vue-i18n';

let languages = {
    title : trans('Languages list'),
    per_page: 10,
    items: {},
    headers: [
    {
        title: "ID",
        code: "id" ,
        dir: "desc",
        is_sort: true,
    },
    {
        title: trans("Title"),
        code: "title",
        dir: "asc",
        is_sort: true,
    },
    {
        title: trans("Code"),
        code: "code",
        dir: "asc",
        is_sort: false,
    },
    {
        title: trans("Created at"),
        code: "created_at",
        dir: "asc",
        is_sort: true,
    },
],
    add: "admin.language.add",
    edit: "admin.language.edit"
}

export default languages;
