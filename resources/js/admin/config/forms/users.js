import axiosInstance from "../../services/axios";

let users = {
    tabs : [
        {
            title : 'Common2',
            active : true,
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
            }
        },
        {
            title : 'Info',
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
