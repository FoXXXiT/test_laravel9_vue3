const state = () => ({
    currentLanguage: [],
});

const getters = {
    getCurrentLanguage: state => state.currentLanguage,
};

const actions = {
    changeLanguage({commit}, language_prefix = 'en') {
        return new Promise((resolve, reject) => {

            const language = JSON.parse(localStorage.getItem('languages')).find(language => language.prefix === language_prefix);


            if (!localStorage.getItem('current_language')) {
                commit('language_success', language);
                localStorage.setItem('current_language', JSON.stringify(language));
            } else {
                commit(
                    'language_success',
                    JSON.parse(localStorage.getItem('current_language'))
                );
            }
            resolve(language);

        });
    },
};

const mutations = {
    language_success(state, currentLanguage) {
        state.currentLanguage = currentLanguage
    }
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}
