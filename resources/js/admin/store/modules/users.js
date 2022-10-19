import DataService from "../../services/DataService";

export default{
    actions :{

        async fetchUsers(ctx){

           DataService.getAll().then(response => {
                const users = response.data.users.data;
                ctx.commit('updateUsers', users);
           })

        }
    },
    mutations :{
        updateUsers(state, posts){
            state.users = posts;
        }
    },
    state :{
        users : []
    },
    getters :{
        allUsers(state){
            return state.users;
        }
    }
}
