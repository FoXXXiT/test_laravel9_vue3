<template>
    <div class="container-fluid">
        <div class="row" v-for="tag in tags.data" v-if="tags.data" id="tags-list">
            <div class="col-12 tag">
                <div class="tag__title">
                    {{ tag.translations[0].name }}
                </div>
            </div>
        </div>
        <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            class="mt-3"
            aria-controls="tags-list"
            @input="onPaginationChangePage"
        ></b-pagination>
    </div>
</template>

<script>

export default {
    name: "Tags",
    created() {
        this.getTags();
    },
    inject: ['$axios'],
    components: {},
    data() {
        return {
            tags: [],
            loading: false,
            perPage: 3,
            currentPage: 1,
        }
    },
    methods: {
        getTags(page = this.currentPage) {
            this.loading = true;
            this.$axios.get('/api/tags', {params: {page}}).then(({data}) => {
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
              this.getTags();
          },
          immediate: true
      }
    },
    computed: {
        rows() {
            return this.tags.total
        }
    }
};
</script>

<style scoped lang="scss">
    .tag {
        border-bottom: 1px solid #121212;
        padding: 15px;
    }
</style>
