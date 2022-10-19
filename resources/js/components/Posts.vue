<template>
    <div class="container-fluid">
        <div class="row" v-for="post in posts.data" v-if="posts.data" id="post-list">
            <div class="col-12 post">
                <div class="post__title">
                    <router-link :to="`/posts/${post.id}`">{{ post.translations[0].title }}</router-link>
                </div>
                <div class="post__description">
                    {{ post.translations[0].description }}
                </div>
            </div>
        </div>
        <b-pagination
            v-model="currentPage"
            v-if="posts?.data?.length > 0"
            :total-rows="rows"
            :per-page="perPage"
            class="mt-3"
            aria-controls="post-list"
            @input="onPaginationChangePage"
        ></b-pagination>

<!--        <p class="mt-3">Current Page: {{ currentPage }}</p>-->
    </div>
</template>

<script>

export default {
    name: "Posts",
    created() {
        this.getPosts();
    },
    inject: ['$axios'],
    components: {},
    data() {
        return {
            posts: [],
            loading: false,
            perPage: 3,
            currentPage: 1,
        }
    },
    methods: {
        getPosts(page = this.currentPage) {
            this.loading = true;
            this.$axios.get('/api/posts', {params: {page}}).then(({data}) => {
                // console.log(data.data);
                this.posts = data;
            });
        },
        onPaginationChangePage (page) {
            this.currentPage = page;
        }
    },
    watch: {
      'currentPage': {
          handler(){
              this.getPosts();
          },
          immediate: true
      }
    },
    computed: {
        rows() {
            return this.posts.total
        }
    }
};
</script>

<style scoped lang="scss">
    .post {
        border-bottom: 1px solid #121212;
        padding: 15px;
    }
</style>
