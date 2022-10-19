import { createRouter, createWebHistory } from "vue-router";
import Login from "../components/Login";

import Posts from "../components/Posts";
import AddPost from "../components/AddPost";
import PostEdit from "../components/PostEdit";
import Post from '../components/Post';

import Tags from "../components/Tags";
import AddTag from "../components/AddTag";

const routes = [
    {
        path: "/",
        name: "Posts",
        component: Posts,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/add-post",
        name: "AddPost",
        component: AddPost,
    },
    {
        path: '/posts/:id',
        name: "Post",
        component: Post,
    },
    {
        path: '/posts/:id/edit',
        name: "PostEdit",
        component: PostEdit,
    },
    {
        path: "/tag",
        name: "Tags",
        component: Tags,
    },
    {
        path: "/add-tag",
        name: "AddTag",
        component: AddTag,
    },
    // {
    //     path: '/posts/:id/edit',
    //     name: "PostEdit",
    //     component: PostEdit,
    // },
    // {
    //     path: '/posts/:id/delete',
    //     name: "PostDelete",
    //     component: PostDelete,
    // },
    // {
    //     path: '/posts/:id/save',
    //     name: "PostSave",
    //     component: PostSave,
    // },
    // {
    //     path: '/tags',
    //     name: "Tags",
    //     component: Tags,
    // },
    // {
    //     path: '/tags/:id',
    //     name: "Tag",
    //     component: Tag,
    // },
    // {
    //     path: '/tags/:id/edit',
    //     name: "TagEdit",
    //     component: TagEdit,
    // },
    // {
    //     path: '/tags/:id/delete',
    //     name: "TagDelete",
    //     component: TagDelete,
    // },
    // {
    //     path: '/tags/:id/save',
    //     name: "TagSave",
    //     component: TagSave,
    // },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
    linkActiveClass: "active",
});

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (this.$store.getters.isLoggedIn) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})

export default router;
