import axiosInstance from "../../services/axios";
import { trans } from 'laravel-vue-i18n';

let users___ = {
    title_add : trans('User add'),
    title_edit : trans('User edit'),
    fields: {
            name: {
                title: trans('Name'),
                'type': 'text',
                value: '',
                er: false,
                message: '',
            },
            lastname: {
                title: trans('Last name'),
                'type': 'text',
                value: '',
                er: false,
                message: '',
            },
            email: {
                title: trans('E-mail'),
                'type': 'text',
                value: '',
                er: false,
                message: ''
            },
            email_verified_at: {
                title: trans('Is verified'),
                'type': 'text',
                value: '',
                er: false,
                message: trans('Please fill field')
            },
            access_panel: {
                title: trans('Panel access'),
                'type': 'select',
                options : [{text : trans('Yes'),  value : 1}, {text : trans('No'),  value : 0}],
                value: '',
                er: false,
                message: ''
            },
            status: {
                title: trans('Status'),
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

function getInfo() {
    return axiosInstance.get('admin/users/create').then((response) => {
        users___.fields.status.options = response.data.statuses ?? null;
    });
}

export default users___;
