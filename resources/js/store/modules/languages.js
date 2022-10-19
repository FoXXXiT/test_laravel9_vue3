import axios from "axios";

const state = () => ({
    languages: [],
    status: ''
});

const getters = {
    getLanguages: state => state.languages,
};

const actions = {
    languages({commit}) {
        return new Promise((resolve, reject) => {
            commit('languages_request')
            axios({url: 'http://localhost/api/languages', method: 'GET'})
                .then(resp => {
                    localStorage.setItem('languages', JSON.stringify(resp.data))
                    commit('languages_success', resp.data)
                    resolve(resp)
                })
                .catch(err => {
                    commit('languages_error')
                    localStorage.removeItem('languages')
                    reject(err)
                })
        })
    },
};

const mutations = {
    languages_request(state) {
        state.status = 'loading'
    },
    languages_success(state, languages) {
        state.status = 'success'
        state.languages = languages
    },
    languages_error(state) {
        state.status = 'error'
    }
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}
