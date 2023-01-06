import router from "@/router";
import client from "../../utilitites/axios_client.utilities";
import { defineStore } from "pinia";

export const useStore = defineStore({
  id: "stores",
  state: () => ({
    stores: [],
    isloading: false,
  }),
  actions: {
    async storeData(data) {
      this.isloading = true;
      // const res = await (await fetch("http://localhost:8000/api/contact", {
      //     method: "POST",
      //     body: JSON.stringify(data),
      // })).json();
      // we can use axios so the fetch method is not method
      const res = await client().post("store/store", data);
      if (res.data.success) {
        alert(res.data.message);
        this.isloading = false;
        router.push("/");
        data.name = "";
        data.email = "";
        data.country = "";
        data.number = "";
      } else {
        this.isloading = false;
        alert(res.data.message);
      }
    },

    async getData() {
      this.isloading = true;
      const res = await client().get("store/store");
      if (res.data.success) {
        this.isloading = false;

        this.stores = res.data.stores;
      }
    },
    async deleteData(id) {
      const res = await client().delete("store/store/" + id);
      if (res.data.success) {
        alert(res.data.message);
      }
    },

    async updateData(data) {
      this.isloading = true;
      const res = await client().post("store/store/" + data.id, data);
      if (res.data.success) {
        alert(res.data.message);
        this.isloading = false;
        router.push("/");
        data.name = "";
        data.email = "";
        data.country = "";
        data.number = "";
      } else {
        this.isloading = false;
        alert(res.data.message);
      }
    },
  },
});
