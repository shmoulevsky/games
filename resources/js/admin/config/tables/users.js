let users = {
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
    { title: "ID", code: "id" },
    { title: "Создано", code: "created_at" },
    { title: "E-mail", code: "email" },
    { title: "Name", code: "name" },
    { title: "Last name", code: "lastname" },
],
    columns: ["id","created_at", "email", "name", "lastname"],
}

export default users;
