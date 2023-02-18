import AppInfoService from '../../services/AppInfoService'
import {loadLanguageAsync} from "laravel-vue-i18n";

export default{
    actions :{
        setInfo(ctx, info){
            ctx.commit('setInfo', info);
        },
        setLanguage(ctx, language){
            ctx.commit('setLanguage', language);
            localStorage.setItem('language', language);
            let current = ctx.getters.getLanguages.filter(item => (parseInt(item.id) === parseInt(language)));
            loadLanguageAsync(current[0].code);
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
            let topMenu = [];
            if(state.info.top_menu && state.language){
                topMenu = state.info.top_menu[state.language]
            }
            return topMenu;
        },
        getSideMenu(state){
            let sideMenu = [];
            if(state.info.side_menu && state.language){
                sideMenu = state.info.side_menu[state.language]
            }
            return sideMenu;
        },
        getLanguage(state){
            return state.language;
        },
    }
}
