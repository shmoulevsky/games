import PageDataService from "../../services/DataService";

export default{
    actions :{

        async fetchPages(ctx){

           PageDataService.getAll().then(response => {
                const pages = response.data.pages.data;
                ctx.commit('updatePages', pages);
           })

        },
        async fetchPage(ctx, code){

            PageDataService.getByCode(code).then(response => {
                 const page = response.data.page;

                 ctx.commit('updatePage', page);
            })

         }
    },
    mutations :{
        updatePages(state, pages){
            state.pages = pages;
        },
        updatePage(state, page){
            state.page = page;
        }
    },
    state :{
        pages : [],
        page : {},
    },
    getters :{
        allPages(state){
            return state.pages;
        },
        getPage(state){
            return state.page;
        },
        getPageText(state){
            return state.page.detail_text;
        }
    }
}
