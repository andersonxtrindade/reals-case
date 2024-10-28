<script setup>
import { RouterLink, RouterView } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
</script>

<template>
  <header>
    <nav>
      <div>
        <RouterLink :to="{ name: 'home' }" class="nav-link">Afiliados</RouterLink>
        <RouterLink :to="{ name: 'users' }" class="nav-link">Usuários</RouterLink>
      </div>
      
      <div v-if="authStore.user" class="flex items-center space-x-6">
        <p class="text-sm text-slate-300">
          Bem-vindo {{ authStore.user.name }}
        </p>
        <form @submit.prevent="authStore.logout">
          <button class="nav-link">Logout</button>
        </form>
      </div>

      <div v-else class="space-x-6">
        <RouterLink :to="{ name: 'register' }" class="nav-link">Registrar-se</RouterLink>
        <RouterLink :to="{ name: 'login' }" class="nav-link">Logar-se</RouterLink>
      </div>
    </nav>
  </header>

  <RouterView />
</template>