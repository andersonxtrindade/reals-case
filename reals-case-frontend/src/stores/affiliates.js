import { defineStore } from "pinia";

export const useAffiliatesStore = defineStore("affiliatesStore", {
  state: () => {
    return {
      errors: {},
      estados: [],
      cidades: [],
    };
  },
  actions: {
    async getAllAffiliates() {
      const res = await fetch("/api/affiliate", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },

    async getAffiliate(affiliate) {
      const res = await fetch(`/api/affiliate/${affiliate}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },

    async createAffiliate(formData) {
      formData.number_phone = String(formData.number_phone)
      const res = await fetch("/api/affiliate", {
        method: "post",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(formData),
      });

      const data = await res.json();

      if (data.errors) {
        this.errors = data.errors;
        console.log('ok')
      } else {
        this.router.push({ name: "home" });
        this.errors = {};
      }
    },

    async deleteAffiliate(affiliate) {
      const res = await fetch(`/api/affiliate/${affiliate.id}`, {
        method: "delete",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });

      const data = await res.json();
      if (res.ok) {
        this.router.push({ name: "home" });
      }
    },

    async updateAffiliate(affiliate, formData) {
      const res = await fetch(`/api/affiliate/${affiliate.id}`, {
        method: "put",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(formData),
      });

      const data = await res.json();

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.router.push({ name: "home" });
        this.errors = {};
      }
    },
    
    async getEstados() {
      try {
        const res = await fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados");
        this.estados = await res.json();
      } catch (error) {
        console.error("Erro ao buscar estados:", error);
      }
    },
    
    async getCidades(siglaEstado) {
      try {
        const res = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${siglaEstado}/municipios`);
        this.cidades = await res.json();
      } catch (error) {
        console.error("Erro ao buscar cidades:", error);
      }
    },
  },
});
