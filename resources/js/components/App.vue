<template>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <router-link to="/" class="logo-link">
                        <img src="/img/logo.svg" alt="" class="logo-image">
                    </router-link>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-3">
            <div class="row">
                <nav class="nav__block col-md-12 d-flex justify-content-center">
                    <ul class="nav__elements">
                        <li class="nav__item">
                            <router-link to="/" class="nav__item__link">Posts</router-link>
                        </li>
                        <li class="nav__item" v-if="isLoggedIn">
                            <router-link to="/add-post" class="nav__item__link">Add Post</router-link>
                        </li>
                        <li class="nav__item">
                            <router-link to="/tags" class="nav__item__link">Tags</router-link>
                        </li>
                        <li class="nav__item" v-if="isLoggedIn">
                            <router-link to="/add-tag" class="nav__item__link">Add Tag</router-link>
                        </li>
                        <li class="nav__item" v-if="!isLoggedIn">
                            <router-link to="/login" class="nav__item__link">Login</router-link>
                        </li>
                        <li class="nav__item" v-if="isLoggedIn">
                            <a @click="logout" class="nav__item__link">Logout</a>
                        </li>
                    </ul>
                </nav>
                <ul class="languages">
                    <li v-for="language in languages">
                        <a v-on:click="changeLanguage(language.prefix)" class="language__link">
                            {{ language.prefix }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <router-view></router-view>
    </main>
    <footer class="footer">
        &copy; 2022
    </footer>
</template>

<script>

export default {
    name: 'App',
    components: {},
    data() {
        return {
            languages: []
        }
    },
    inject: ['$axios'],
    created: function(){
        this.$axios.interceptors.response.use(undefined, function (err) {
            return new Promise(function (resolve, reject) {
                if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
                    this.$store.dispatch("auth/logout")
                }
                throw err;
            });
        });
        this.getLanguages();
        this.$store.dispatch('currentLanguage/changeLanguage');
    },
    computed : {
        isLoggedIn : function(){ return this.$store.getters['auth/isLoggedIn'] }
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout')
                .then(() => {
                    this.$router.push('/login')
                })
        },
        getLanguages() {
          this.$store.dispatch('languages/languages').then(({data})=> this.languages = data);
        },
        changeLanguage(prefix) {
            this.$store.dispatch('currentLanguage/changeLanguage', prefix)
                .then(language=> console.log(language))
        }
    },
}
</script>

<style lang="scss">
#app {
    font-family: 'Nunito', sans-serif;
    color: #121212;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
}

.header {
    width: 100%;
    min-height: 200px;
    border-bottom: 2px solid #ccc;
    flex: 0 0 100%;
    padding: 20px 0;
}

main {
    min-height: calc(100vh - 200px - 200px);
    width: 100%;
}

.nav {
    &__block {
        background: #318ef1;
        max-height: 40px;
    }
    &__elements {
        list-style: none;
        display: flex;

    }
    &__item {
        &__link {
            color: #fff;
            text-decoration: none;
            line-height: 40px;
            display: block;
            padding: 0 15px;

            &:hover {
                background: #0c1c2a;
                color: #fff;
                cursor: pointer;
            }
        }
    }
}

.logo {
    &-link {
        display: block;
    }
    &-image {
        width: 200px;
    }
}



.footer {
    width: 100%;
    min-height: 200px;
    border-top: 2px solid #ccc;
    flex: 0 0 100%;
    padding: 20px 0;
    text-align: center;
}

.logo {
    max-width: 200px;
}

.languages {
    display: flex;
    position: absolute;
    top: 0;
    right: 0;
    list-style: none;
    justify-content: center;
    max-width: 150px;
    gap: 15px;

    & .language__link {
        text-transform: uppercase;
        color: #0a53be;

        &:hover {
            cursor: pointer;
            color: #0c1c2a;
        }
    }
}
</style>
