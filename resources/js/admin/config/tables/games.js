import { trans } from 'laravel-vue-i18n';

let games = {
    title : trans('Games list'),
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
        code: "category",
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
    add: "admin.game.add",
    edit: "admin.game.edit"
}

export default games;
