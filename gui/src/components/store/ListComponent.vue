<template>
  <div>
    <v-container class="my-3">
      <div v-if="isloading">Loading.....</div>
      <div v-else>
        <table style="width: 100%">
          <thead>
            <tr style="width: 100%">
              <th class="text-left">Id</th>
              <th class="text-left">Name</th>
              <th class="text-left">Email</th>
              <th class="text-left">Country</th>
              <th class="text-left">Number</th>
              <th class="text-left">Edit</th>
              <th class="text-left">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr
              style="width: 100%"
              v-for="(store, index) in stores"
              :key="index"
            >
              <td class="text-left pa-3">{{ index + 1 }}</td>
              <td class="text-left pa-3">{{ store.name }}</td>
              <td class="text-left pa-3">{{ store.email }}</td>
              <td class="text-left pa-3">{{ store.country }}</td>
              <td class="text-left pa-3">{{ store.number }}</td>
              <td class="text-left pa-3">
                <router-link :to="`/update/${store.id}`">
                  <v-btn color="success" text>Edit</v-btn></router-link
                >
              </td>
              <td class="text-left">
                <v-btn color="error" text @click="deletedata(store.id)"
                  >Delete</v-btn
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </v-container>
  </div>
</template>
<script>
import { mapActions, mapState } from "pinia";
import { useStore } from "../../stores/store/index";
export default {
  name: "tabelComp",
  computed: {
    ...mapState(useStore, ["stores", "isloading"]),
  },
  methods: {
    ...mapActions(useStore, ["getData", "deleteData"]),
    // ...mapActions(useStore, []),
    deletedata(id) {
      this.deleteData(id);
      //   i will take a time to fetch the data
      this.getData();
    },
  },
  mounted() {
    this.getData();
  },
};
</script>
