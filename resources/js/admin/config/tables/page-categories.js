import { trans } from 'laravel-vue-i18n';

let pageCategories = {
    title : trans('Page categories list'),
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
        title: trans("Picture"),
        code: "thumb",
        type: "img",
        dir: "asc",
        is_sort: false,
    },
    {
        title: trans("Category"),
        code: "parent_id",
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
    add: "admin.page-categories.add",
    edit: "admin.page-categories.edit"
}

export default pageCategories;
