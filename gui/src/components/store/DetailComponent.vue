<script setup>
let {VITE_API_HOST}=import.meta.env;
</script>
<template>
  <div>
    <v-container class="my-3">
      <div v-if="isloading">Loading.....</div>
      <div v-else class="row justify-content-around">
       
          <div class="tarjet-store__header">
            <div class="schedule-store">
              Hoy {{ store.start_time }} - {{ store.end_time }}
            </div>
            <div class="tarjet-store__delivery">Retiro o delivery</div>
            <img
              class="profile-store"
              :src="VITE_API_HOST+'documents/' + (store.document && store.document.name)"
            />
          </div>
          <div class="tarjet-footer">
            <h6>{{ store.display_name }}</h6>
            <h6>{{ parseFloat(store.km).toFixed(2) }} Km</h6>

          </div>
      </div>
    </v-container>
  </div>
</template>
<script>
import { mapActions, mapState } from "pinia";
import { useStore } from "../../stores/store/index";
export default {
  name: "DetailComp",
  computed: {
    ...mapState(useStore, ["store", "isloading"]),
  },
  methods: {
    ...mapActions(useStore, ["getDataStore"]),
    // ...mapActions(useStore, []),
   
  },
  mounted() {
    this.getDataStore(1);
  },
};
</script>
<style lang="scss" scoped>
$color_red: red;
$color_pink: rgb(225, 47, 241);
$color_pink_softy: rgb(246, 207, 249);

.tarjet-store {
  border-radius: 12px;
  margin-bottom: 12px;
  margin-top: 8px;
  margin-left: 7px;
  margin-right: 7px;
  max-width: 400px;
  height: 200px;
  padding: 0px !important;
  box-shadow: 0 10px 16px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
}
.tarjet-store__header {
  position: relative;
  background-image: url("@/assets/images/store/fruit.jpeg");
  background-size: 100%;
  width: 100%;
  height: 45%;
  border-top-right-radius: 12px;
  border-top-left-radius: 12px;
}
.schedule-store {
  background-color: $color_pink;
  font-size: 1rem;
  width: 12rem;
  border-radius: 12px;
  text-align: center;
  color: white;
  margin-top: 1rem;
  margin-left: 1rem;

  position: absolute;
}
.tarjet-store__delivery {
  color: $color_pink;
  background-color: $color_pink_softy;
  margin-top: 3rem;
  margin-left: 1rem;
  width: 10rem;
  border-radius: 12px;
  text-align: center;
  position: absolute;
}
.profile-store {
  width: 5rem;
  height: 5rem;
  border-radius: 100%;
  position: absolute;
  right: 2rem;
  top: 3rem;
}
.tarjet-footer {
  padding: 3px;
}
.tarjet-footer h6 {
  color: black;
}
</style>
