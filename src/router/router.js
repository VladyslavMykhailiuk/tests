import MainPage from "@/Pages/MainPage.vue";
import PostFormPage from "@/Pages/PostFormPage.vue";
import { createRouter, createWebHashHistory } from "vue-router";
import LoginPage from "@/Pages/LoginPage.vue";
import RegisterPage from "@/Pages/RegisterPage.vue";
import PostsListPage from "@/Pages/PostsListPage.vue";
import OnePost from "@/components/OnePost.vue";
// import OnePost from "@/components/OnePost.vue";
const routes = [
    {
        path: "/",
        component: MainPage
    },
    {
        path: "/login",
        component: LoginPage
    },
    {
        path: "/register",
        component: RegisterPage
    },
    {
        path: "/form",
        component: PostFormPage
    },
    {
        path: "/posts",
        component: PostsListPage
    },
    {
        path: '/post/:id',
        name: 'post',
        component: OnePost,
        props: true,
    },
]


const router = createRouter({
    routes,
    history: createWebHashHistory(process.env.BASE_URL)
})



// router.beforeEach(async (to, from, next) => {
//
// })


export default router;