import { defineStore } from "pinia";

export const useCommissionsStore = defineStore("commissionsStore", {
  state: () => {
    return {
      errors: {},
      estados: [],
      cidades: [],
    };
  },
  actions: {
    async getAllCommissions() {
      const res = await fetch("/api/commission", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },

    async getCommission(commission) {
      const res = await fetch(`/api/commission/${commission}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },

    async createCommission(formData) {
      const res = await fetch("/api/commission", {
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

    async deleteCommission(id) {
      console.log(id)
      const res = await fetch(`/api/commission/${id}`, {
        method: "delete",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });

      const data = await res.json();
      console.log(res.ok)
      if (res.ok) {
        console.log("Comissão deletada com sucesso.");
        this.router.push({ name: "home" });
      }
    },

    async updateCommission(commission, formData) {
      const res = await fetch(`/api/commission/${commission.id}`, {
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
  },
});
