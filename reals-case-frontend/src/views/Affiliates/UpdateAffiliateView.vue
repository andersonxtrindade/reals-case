<script setup>
import { reactive, ref, watch, onMounted, nextTick } from 'vue';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '@/stores/auth';
import { useAffiliatesStore } from "@/stores/affiliates";
import { useRoute, useRouter } from "vue-router";

const authStore = useAuthStore();
const affiliatesStore = useAffiliatesStore();

const { errors } = storeToRefs(authStore);
const { estados, cidades } = storeToRefs(affiliatesStore);
const affiliate = ref(null);

const { updateAffiliate, getAffiliate } = useAffiliatesStore();

const router = useRouter();
const route = useRoute();
const selectedEstado = ref("");
const selectedCidade = ref("");

const formData = reactive({
  name: "",
  cpf: "",
  birth_date: "",
  email: "",
  number_phone: "",
  address: "",
  city: selectedCidade,
  state: selectedEstado,
  active: true
});

onMounted(async () => {
  affiliatesStore.getEstados();
  affiliate.value = await getAffiliate(route.params.id);

  formData.name = affiliate.value.name;
  formData.cpf = affiliate.value.cpf;
  formData.birth_date = affiliate.value.birth_date;
  formData.email = affiliate.value.email;
  formData.number_phone = affiliate.value.number_phone;
  formData.address = affiliate.value.address;
  formData.email = affiliate.value.email;
  formData.active = Boolean(affiliate.value.active); 

  selectedEstado.value = affiliate.value.state;
  await affiliatesStore.getCidades(selectedEstado.value);
  
  await nextTick();
  selectedCidade.value = affiliate.value.city;
});

watch(selectedEstado, (newEstado) => {
  if (newEstado) {
    affiliatesStore.getCidades(newEstado);
    selectedCidade.value = ""; 
  }
});

watch(() => errors, (newErrors) => {
  console.log("Erros mudaram:", newErrors); // Isso ajudará a ver quando os erros mudam
});
</script>

<template>
  <main>
    <h1 class="title">Registre um novo afiliado</h1>
    <p>{{ errors.name }}</p>

    <form @submit.prevent="affiliatesStore.updateAffiliate(affiliate, formData)"
      class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto space-y-6 p-4 bg-white rounded-lg shadow-lg">
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Nome</label>
          <input required type="text"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.name">
          <p v-if="errors.name" class="error">{{ errors.name[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">CPF</label>
          <input required type="text"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.cpf">
            <p v-if="errors.cpf" class="error">{{ errors.cpf[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
          <input required type="date"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.birth_date">
            <p v-if="errors.birth_date" class="error">{{ errors.birth_date[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">E-mail</label>
          <input required type="email"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.email">
            <p v-if="errors.email" class="error">{{ errors.email[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Número de Telefone</label>
          <input required type="number"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.number_phone">
            <p v-if="errors.number_phone" class="error">{{ errors.number_phone[0] }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Endereço</label>
          <input required type="text"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            v-model="formData.address">
            <p v-if="errors.address" class="error">{{ errors.address[0] }}</p>
        </div>
    
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select required
                id="estado"
                v-model="selectedEstado"
                @change="fetchCidades"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
                <option value="" disabled>Selecione um estado</option>
                <option v-for="estado in estados" :key="estado.id" :value="estado.sigla">
                {{ estado.nome }}
                </option>
            </select>
        </div>
        
        <div>
            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
            <select required
                id="cidade"
                v-model="selectedCidade"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
                <option value="" disabled>Selecione uma cidade</option>
                <option v-for="cidade in cidades" :key="cidade.id" :value="cidade.nome">
                {{ cidade.nome }}
                </option>
            </select>
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
