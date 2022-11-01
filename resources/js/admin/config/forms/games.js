import axiosInstance from "../../services/axios";
import {trans} from "laravel-vue-i18n";

let games = {
    title_add : trans('Game add'),
    title_edit : trans('Game edit'),
    tabs : [
        {
            title : "Common",
            active : true,
            languages : true,
            fields: {
                title: {
                    title: 'Title',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: '',
                },
                description: {
                    title: 'Description',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: '',
                },
                rules: {
                    title: 'Rules',
                    'type': 'textarea',
                    value: '',
                    er: false,
                    message: '',
                },
            }
        },
        {
            title : "Settings",
            active : false,
            fields: {
                thumb: {
                    title: 'Thumb',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: ''
                },
                game: {
                    title: 'Game',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: ''
                },
                sort: {
                    title: 'Sort',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: ''
                },
                is_active: {
                    title: 'Is active',
                    'type': 'select',
                    options : [{text : trans('Yes'),  value : 1}, {text : trans('No'),  value : 0}],
                    value: '',
                    er: false,
                    message: ''
                },
                status: {
                    title: 'Status',
                    'type': 'select',
                    value: '',
                    er: false,
                    message: '',
                    options : {},
                    getInfo : {
                        'arguments': 'axios, field',
                        'body': `return axios.get(\'admin/games/create\').then((response) => {
                                field.options = response.data.statuses ?? null;

                            });`
                    }
                }
            }
        }
    ],
}

export default games;
