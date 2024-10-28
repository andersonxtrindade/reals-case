<template>
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-11/12 sm:w-2/3 lg:w-2/4">
            <h2 class="text-xl font-bold mb-4">Detalhes da Comissão de {{ affiliate?.name }}</h2>
            <RouterLink :to="{ name: 'newcommission', params: { id: affiliate?.id } }"
                class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition duration-200">
                Adicionar Comissões
            </RouterLink>
            <div v-if="affiliate?.commission.length > 0" class="container mx-auto p-4 overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-2 px-4 text-left">ID</th>
                            <th class="py-2 px-4 text-left">Valor</th>
                            <th class="py-2 px-4 text-left">Data</th>
                            <th class="py-2 px-4 text-left">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="commission in affiliate.commission" :key="commission.id" class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ commission.id }}</td>
                            <td class="py-2 px-4">R$ {{ commission.value.toFixed(2).replace('.', ',') }}</td>
                            <td class="py-2 px-4">{{ new Date(commission.date).toLocaleDateString('pt-BR') }}</td>
                            <td class="py-2 px-4">
                                <button @click="handleDeleteCommission(commission.id)" class="text-red-500 font-bold px-2 py-1 border border-red-300">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <h2 class="mt-4">Não há comissões</h2>
            </div>
            <button @click="closeModal" class="mt-4 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">Fechar</button>
        </div>
    </div>
</template>

<script setup>
import { useCommissionsStore } from "@/stores/commissions";
import { RouterLink } from "vue-router";
import { ref, toRefs, watch } from "vue";
import { defineEmits } from 'vue'; 

const emit = defineEmits(); 

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
    affiliate: {
        type: Object,
        default: null,
    },
    onUpdate: Function
});

const { deleteCommission } = useCommissionsStore();

async function handleDeleteCommission(id) {
    if (confirm("Você tem certeza que deseja deletar esta comissão?")) {
        await deleteCommission(id);
        props.onUpdate();
        closeModal();
    }
}

function closeModal() {
    emit("close");
}
</script>
