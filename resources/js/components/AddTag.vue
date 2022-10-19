<script>
import * as yup from 'yup';
import {Form, Field} from "vee-validate";
import {BCard} from "bootstrap-vue-3";
// import {reactive} from "vue";

const schema = yup.object({
    email: yup.string().required,
    password: yup.string().required,
});


export default {
    name: "AddTag",
    inject: ['$store'],
    data() {
        return {
            current_language: null,
            tag: {
                'en': {
                    name: ''
                },
                'ru': {
                    name: ''
                },
                'uk': {
                    name: ''
                },
            }
        }
    },
    created() {
        this.current_language = 'en';
    },
    components: {
        Form,
        Field,
        BCard
    },
    methods: {
        onSubmit(data) {
            // console.log('Email:' + data.email);
            // console.log('Password:' + data.password);

            let email = data.email;
            let password = data.password;

            this.$store.dispatch('auth/login', {email, password})
                .then(() => this.$router.push('/'))
                .catch(err => console.error(err));

        },
        changeTab({target}) {
            // console.log(target.textContent);
            this.current_language = target.textContent;

            // if(!this.post[this.currentLanguage]) {
            //     this.post[this.current_language]
            // }
        },
        setText({target}) {
            this.post[this.current_language] = {...this.post[this.current_language], title: target.value};
        },
        setDescription({target}) {
            this.post[this.current_language] = {...this.post[this.current_language], description: target.value};
        },
        setContent({target}) {
            this.post[this.current_language] = {...this.post[this.current_language], content: target.value};
        },
        setTags({target}) {
            this.post[this.current_language] = {...this.post[this.current_language], tags: target.value};
        },

    },
    watch: {
        'tag': {
            handler(post) {
                console.log('post_changed');
                console.log(post);
            },
            immediate: true
        }
    },
    computed: {
        schema,
        languages: function () {
            return this.$store.getters['languages/getLanguages']
        }
    }
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 p-3">
                <Form
                    @submit="onSubmit"
                    :validation-schema="schema"
                    method="post"
                    action="#"
                >
                    <b-card no-body>
                        <b-tabs card>
                            <b-tab
                                :title="language.prefix"
                                v-for="language in languages"
                                v-on:click="changeTab"
                            >
                                <b-card-text>
                                    <div class="form-group mb-2">
                                        <Field
                                            name="name"
                                            type="text"
                                            label="Name"
                                            placeholder="Name"
                                            class="form-control"
                                        />
                                    </div>
                                </b-card-text>
                            </b-tab>
                        </b-tabs>
                    </b-card>


                    <div class="form-group mt-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
