import BootstrapVue3 from 'bootstrap-vue-3'
import { createApp } from "vue";

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'

import App from "./components/App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";



const token = localStorage.getItem('token')

if (token) {
    axios.defaults.headers.common['Authorization'] = token
}

const app = createApp(App);

app.provide('$axios', axios);
app.provide('$store', store);
app.use(store);
app.use(router);
app.use(BootstrapVue3);

const languages = localStorage.getItem('languages');

if(languages){
    app.provide('languages', languages);
}

app.mount("#app");
