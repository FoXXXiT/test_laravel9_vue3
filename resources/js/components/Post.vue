<template>
    <div class="container-fluid">
        <div class="row" v-if="isLoggedIn">
            <div class="button-group d-flex justify-content-end gap-2">
                <router-link :to="`/posts/${postId}/edit`" class="btn btn-primary">Edit</router-link>
                <a @click.prevent="deletePost" class="btn btn-danger">Delete</a>
            </div>
        </div>
        <div class="row" v-if="post">
            <div class="col-12 post">
                <div class="post__title">
                    <h1>{{ post.translations[0].title }}</h1>
                </div>
                <div class="post__content">
                    {{ post.translations[0].content }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Post",
    created() {
        this.postId = this.$route.params.id;
        this.getPost(this.postId);
    },
    computed: {
        isLoggedIn : function(){ return this.$store.getters['auth/isLoggedIn'] }
    },
    inject: ['$axios'],
    components: {},
    data() {
        return {
            post: {},
            postId: null,
            loading: false,
        }
    },
    methods: {
        getPost(postId) {
            this.loading = true;
            this.$axios.get(`/api/posts/${postId}`).then(({data}) => {
                console.log(data.data);
                this.post = data.data;
            });
        },
        deletePost() {
            this.$axios.delete(`/api/posts/${this.postId}`)
                .then(()=>{
                    this.$router.push('/');
                }
            );
        }
    }
};
</script>

<style scoped lang="scss">
    .post {
        border-bottom: 1px solid #121212;
    }
</style>
