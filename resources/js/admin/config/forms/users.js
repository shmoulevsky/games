import axiosInstance from "../../services/axios";
import {trans} from "laravel-vue-i18n";

let users = {
    title_add : trans('User add'),
    title_edit : trans('User edit'),
    tabs : [
        {
            title : "Common",
            active : true,
            languages : true,
            fields: {
                name: {
                    title: 'Имя',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: '',
                },
                lastname: {
                    title: 'Фамилия',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: '',
                },
                message: {
                    title: 'Фамилия',
                    'type': 'textarea',
                    value: '',
                    er: false,
                    message: '',
                },
            }
        },
        {
            title : "Info",
            active : false,
            fields: {
                email: {
                    title: 'E-mail',
                    'type': 'text',
                    value: '',
                    er: false,
                    message: ''
                },
                status: {
                    title: 'Статус',
                    'type': 'select',
                    value: '',
                    er: false,
                    message: '',
                    options : {},
                    getInfo : {
                        'arguments': 'axios, field',
                        'body': `return axios.get(\'admin/users/create\').then((response) => {
                                field.options = response.data.statuses ?? null;
                                console.log(field.options);
                            });`
                    }
                }
            }
        }
    ],
}

function getInfo() {
    return axiosInstance.get('admin/users/create').then((response) => {
        users.fields.status.options = response.data.statuses ?? null;
    });
}

export default users;
