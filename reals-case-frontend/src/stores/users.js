import { defineStore } from "pinia";

export const useUsersStore = defineStore("usersStore", {
  state: () => {
    return {
      errors: {},
    };
  },
  actions: {
    async getAllUsers() {
      const res = await fetch("/api/user", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },

    async getUser(user) {
      const res = await fetch(`/api/user/${user}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },

    async createUser(formData) {
      const res = await fetch("/api/user", {
        method: "post",
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

    async deleteUser(user) {
      const res = await fetch(`/api/user/${user.id}`, {
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

    async updateUser(user, formData) {
      const res = await fetch(`/api/user/${user.id}`, {
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
