import { createRouter, createWebHistory } from 'vue-router'
import RegisterView from '@/views/Auth/RegisterView.vue'
import LoginView from '@/views/Auth/LoginView.vue'
import { useAuthStore } from '@/stores/auth'
import ShowUserView from '@/views/Users/ShowUserView.vue'
import UpdateUserView from '@/views/Users/UpdateUserView.vue'
import ShowAffiliateView from '@/views/Affiliates/ShowAffiliateView.vue'
import CreateAffiliateView from '@/views/Affiliates/CreateAffiliateView.vue'
import UpdateAffiliateView from '@/views/Affiliates/UpdateAffiliateView.vue'
import CreateCommissionView from '@/views/Commissions/CreateCommissionView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ShowAffiliateView,
      meta: { auth: true }
    },
    {
      path: '/affiliates/new',
      name: 'newaffiliate',
      component: CreateAffiliateView,
      meta: { auth: true }
    },
    {
      path: '/commission/new/:id',
      name: 'newcommission',
      component: CreateCommissionView,
      meta: { auth: true }
    },
    {
      path: '/users',
      name: 'users',
      component: ShowUserView,
      meta: { auth: true }
    },
    {
      path: "/users/:id",
      name: "update",
      component: UpdateUserView,
      meta: { auth: true }
    },
    {
      path: "/affiliate/:id",
      name: "updateAffiliate",
      component: UpdateAffiliateView,
      meta: { auth: true }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      meta: { guest: true },
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { guest: true },
    },
  ]
})

router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();
  await authStore.getUser();

  if (authStore.user && to.meta.guest) {
    return { name: "home" };
  }

  if (!authStore.user && to.meta.auth) {
    return { name: "login" };
  }
});

export default router
