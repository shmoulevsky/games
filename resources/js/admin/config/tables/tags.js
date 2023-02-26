import { trans } from 'laravel-vue-i18n';

let tags = {
    title : trans('Tags list'),
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
        type: "url",
        url: "url",
        dir: "asc",
        is_sort: true,
    },
    {
        title: trans("Created at"),
        code: "created_at",
        dir: "asc",
        is_sort: true,
    },
],
    add: "admin.tag.add",
    edit: "admin.tag.edit"
}

export default tags;
