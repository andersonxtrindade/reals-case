<script setup>
import { useAuthStore } from "@/stores/auth";
import { useUsersStore } from "@/stores/users";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

const route = useRoute();
const { getAllUsers, deleteUser } = useUsersStore();
const authStore = useAuthStore();
const users = ref([]);

onMounted(async () => (users.value = await getAllUsers()));
</script>

<template>
  <main>
    <div v-if="users" class="container mx-auto p-4 overflow-x-auto">
      <h1 class="text-2xl font-bold mb-4">Lista de Usuário</h1>
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="py-2 px-4 text-left">ID</th>
            <th class="py-2 px-4 text-left">Nome</th>
            <th class="py-2 px-4 text-left">E-mail</th>
            <th class="py-2 px-4 text-left">Atualizar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="border-b hover:bg-gray-50">
            <td class="py-2 px-4">{{ user.id }}</td>
            <td class="py-2 px-4">{{ user.name }}</td>
            <td class="py-2 px-4">{{ user.email }}</td>
            <td class="py-2 px-4">
              <RouterLink
                :to="{ name: 'update', params: { id: user.id } }"
                class="m-1 py-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200"
                >Atualizar</RouterLink
              >
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else>
      <h2 class="title">Page not found!</h2>
    </div>
  </main>
</template>