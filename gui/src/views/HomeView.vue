<template>
  <div class="container">
  <!--   <div class="bg-dark">
      <v-container class="p-4">
        <h2 class="text-center text-white">Tiendas</h2>
      </v-container>
    </div> -->
   <!--  <v-container class="my-3">
      <v-card>
        <div class="d-flex justify-space-between align-center pa-3">
          <v-card-title>Tiendas(0)</v-card-title>
          <router-link to="/create">
            <v-btn text color="success">New</v-btn></router-link
          >
        </div>
      </v-card>
    </v-container> -->
    <ListComponentVue />
  </div>
</template>

<script>
import ListComponentVue from "@/components/store/ListComponent.vue";
export default {
  name: "HomeView",
  components: {
    ListComponentVue,
  },
};
</script>

