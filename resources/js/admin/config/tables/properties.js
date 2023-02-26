import { trans } from 'laravel-vue-i18n';

let properties = {
    title : trans('Properties list'),
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
    }
],
    add: "admin.property.add",
    edit: "admin.property.edit"
}

export default properties;
