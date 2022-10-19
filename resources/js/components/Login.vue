<script>
import * as yup from 'yup';
import { Form, Field } from "vee-validate";

const schema = yup.object({
    email: yup.string().required,
    password: yup.string().required,
});


export default {
    name: "Login",
    inject: ['$store'],
    data() {
        return {
            email: '',
            password: '',
        }
    },
    components: {
        Form,
        Field,
    },
    methods: {
        onSubmit(data) {
            // console.log('Email:' + data.email);
            // console.log('Password:' + data.password);

            let email = data.email;
            let password = data.password;

            this.$store.dispatch('auth/login', {email, password})
                .then(()=>this.$router.push('/'))
                .catch(err=>console.error(err));

        }
    },
    computed: {
        schema
    }
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 p-3">
                <Form @submit="onSubmit" :validation-schema="schema" method="post" action="#">
                    <div class="form-group mb-2">
                        <Field
                            name="email"
                            type="email"
                            label="E-mail"
                            placeholder="E-mail"
                            success-message="Validated!"
                            class="form-control"
                            v-slot="email"
                        />
                    </div>
                    <div class="form-group mb-2">
                        <Field
                            name="password"
                            type="password"
                            label="Password"
                            placeholder="Password"
                            success-message="Validated!"
                            class="form-control"
                            v-slot="password"
                        />
                    </div>
                    <div class="form-group mb-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
