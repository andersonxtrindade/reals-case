<script setup>
import { reactive, watch } from 'vue';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '@/stores/auth';

const { errors } = storeToRefs(useAuthStore());
const { authenticate } = useAuthStore();

const formData = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  active: false
});
</script>

<template>
  <main>
    <h1 class="title">Registre uma nova conta</h1>

    <form @submit.prevent="authenticate('register', formData)"
      class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto space-y-6 p-4 bg-white rounded-lg shadow-lg">
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Nome</label>
          <input type="text"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.name">
          <p v-if="errors.name" class="error">{{ errors.name[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.email">
            <p v-if="errors.email" class="error">{{ errors.email[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Senha</label>
          <input type="password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.password">
            <p v-if="errors.password" class="error">{{ errors.password[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
          <input type="password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.password_confirmation">
            <p v-if="errors.password_confirmation" class="error">{{ errors.password_confirmation[0] }}</p>
        </div>

        <div>
          <input type="checkbox"
            class="w-4 h-4 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
            v-model="formData.active">
          <span class="ml-2 text-gray-700">Ativo?</span>
          <p v-if="errors.active" class="error">{{ errors.active[0] }}</p>
        </div>

        <div>
          <button type="submit"
            class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">Enviar</button>
        </div>
      </div>
    </form>

  </main>
</template>
