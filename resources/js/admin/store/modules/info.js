import {loadLanguageAsync} from "laravel-vue-i18n";
export default{
    actions :{
        setLanguage(ctx, language){
            ctx.commit('setLanguage', language);
            localStorage.setItem('language', language);
        },
        setInfo(ctx, info){
            ctx.commit('setInfo', info);
        }
    },
    mutations :{
        setInfo(state, info){
            state.info = info;
        },
        setLanguage(state, language){
            state.language = language;
            let current = state.info.languages.filter(item => (parseInt(item.id) === parseInt(language)));
            loadLanguageAsync(current[0].code);
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

            let languages = state.info.languages;

            for(let key in languages){
                languages[key].is_active = parseInt(languages[key].id) === parseInt(state.language);
            }

            return languages ?? [];
        },
        getLanguage(state){
            return state.language;
        },
    }
}
