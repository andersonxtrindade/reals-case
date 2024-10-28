<script setup>
import { reactive, ref, watch, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '@/stores/auth';
import { useCommissionsStore } from "@/stores/commissions";

import { useRoute } from 'vue-router';

const route = useRoute();
const affiliateId = route.params.id;
const authStore = useAuthStore();
const commissionsStore = useCommissionsStore();

const { errors } = storeToRefs(authStore);

const { createCommission } = useCommissionsStore();

const formData = reactive({
  affiliates_id: affiliateId,
  value: "",
  date: "",
});

onMounted(() => {
    
});
</script>

<template>
  <main>
    <h1 class="title">Registre um novo afiliado</h1>
    <p>{{ errors.name }}</p>

    <form @submit.prevent="commissionsStore.createCommission(formData)"
      class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto space-y-6 p-4 bg-white rounded-lg shadow-lg">
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Data da Comissão</label>
          <input required type="date"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.date">
            <p v-if="errors.date" class="error">{{ errors.date[0] }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Valor</label>
            <input
                type="number" placeholder="0.00" required name="price" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                v-model="formData.value"
            />
            <p v-if="errors.value" class="error">{{ errors.value[0] }}</p>
        </div>

        <div>
          <button type="submit"
            class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">Enviar</button>
        </div>
      </div>
    </form>

  </main>
</template>
