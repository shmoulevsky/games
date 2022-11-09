import AppInfoService from '../../services/AppInfoService'

export default{
    actions :{
        async getInfo(ctx){
            AppInfoService.getInfo().then(response => {
                let info = response.data;
                ctx.commit('setInfo', info);
            })

        },
        setLanguage(ctx, language){
            ctx.commit('setLanguage', language);
            localStorage.setItem('language', language);
        }
    },
    mutations :{
        setInfo(state, info){
            state.info = info;
        },
        setLanguage(state, language){
            state.language = language;
        }
    },
    state :{
        info : {},
        language : null,
    },
    getters :{
        getInfo(state){
            return state.info;
        },
        getLanguages(state){
            return state.info.languages ?? [];
        },
        getTopMenu(state){
            return state.info.top_menu[state.language] ?? [];
        },
        getLanguage(state){
            return state.language;
        },
    }
}
