<script setup>
import { useAuthStore } from "@/stores/auth";
import { useAffiliatesStore } from "@/stores/affiliates";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";
import ComissoesModal from "@/views/Commissions/ComissoesModal.vue";

const route = useRoute();
const { getAllAffiliates, deleteAffiliate } = useAffiliatesStore();
const authStore = useAuthStore();
const affiliates = ref([]);

const isModalOpen = ref(false); 
const selectedAffiliate = ref(null); 

function openModal(affiliate) {
  selectedAffiliate.value = affiliate;
  isModalOpen.value = true;
}

async function fetchAffiliates() {
  affiliates.value = await getAllAffiliates();
}

function closeModal() {
  isModalOpen.value = false;
}

onMounted(fetchAffiliates);
</script>

<template>
  <main>
    <div class="container mx-auto p-4 flex justify-between">
      <h1 class="text-2xl font-bold mb-4">Lista de Afiliados</h1>
      <RouterLink :to="{ name: 'newaffiliate' }"
        class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition duration-200">
        Adicionar Afiliado
      </RouterLink>
    </div>
    <div v-if="affiliates" class="container mx-auto p-4 overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="py-2 px-4 text-left">ID</th>
            <th class="py-2 px-4 text-left">Nome</th>
            <th class="py-2 px-4 text-left">Telefone</th>
            <th class="py-2 px-4 text-left">Endereço</th>
            <th class="py-2 px-4 text-left">E-mail</th>
            <th class="py-2 px-4 text-left">Total de Comissões</th>
            <th class="py-2 px-4 text-left">Comissões</th>
            <th class="py-2 px-4 text-left">Atualizar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="affiliate in affiliates" :key="affiliate.id" class="border-b hover:bg-gray-50">
            <td class="py-2 px-4">{{ affiliate.id }}</td>
            <td class="py-2 px-4">{{ affiliate.name }}</td>
            <td class="py-2 px-4">{{ affiliate.number_phone }}</td>
            <td class="py-2 px-4">{{ affiliate.address }}</td>
            <td class="py-2 px-4">{{ affiliate.email }}</td>
            <td class="py-2 px-4">{{ affiliate.commission.length }}</td>
            <td class="py-2 px-4">
              <button @click="openModal(affiliate)"
                class="my-1 py-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">Comissões</button>
            </td>
            <td class="py-2 px-4">
              <RouterLink :to="{ name: 'updateAffiliate', params: { id: affiliate.id } }"
                class="my-1 py-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                Atualizar</RouterLink>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else>
      <h2 class="title">Página não encontrada!</h2>
    </div>

    <ComissoesModal :isOpen="isModalOpen" @close="closeModal" :affiliate="selectedAffiliate" :onUpdate="fetchAffiliates"  />
  </main>
</template>