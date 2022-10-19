import {createStore} from 'vuex';
import createPersistedState from "vuex-persistedstate";
import auth from "./modules/auth";
import languages from "./modules/languages";
import currentLanguage from './modules/currentLanguage';

export default createStore({
    modules: {
        auth,
        languages,
        currentLanguage
    },
    plugins: [createPersistedState()],
})
