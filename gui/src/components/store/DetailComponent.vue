<script setup>
let { VITE_API_HOST } = import.meta.env;
</script>
<template>
  <div>
    <v-container class="my-3">
      <div v-if="isloading">Loading.....</div>
      <div v-else class="">
        <div class="header-detail-store">
          <img
            class="profile-store-detail"
            :src="
              VITE_API_HOST +
              'documents/' +
              (store.document && store.document.name)
            "
          />
        </div>
        Categorias
        <div v-for="(category, index) in store.categories" :key="index">
          <li>{{ category.name }}</li>
        </div>
        <div class="row justify-content-around">
          <div
            class="tarjet-product col-3"
            v-for="(product, index) in store.products"
            :key="index"
            :title="product.name"
            v-title
          >
            <div class="container-profile-product">
              <img
                class="profile-product"
                :src="
                  VITE_API_HOST +
                  'documents/' +
                  (product.document && product.document.name)
                "
              />
            </div>
            <span class="color-pink">$ {{ product.price }}</span>
            <p>{{ product.description }}</p>
          </div>
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
    this.getDataStore(this.$route.params.id);
  },
};
</script>
<style lang="scss" scoped>
$color_red: red;
$color_pink: rgb(225, 47, 241);
$color_pink_softy: rgb(246, 207, 249);
.header-detail-store {
  background-image: url("@/assets/images/store/fruit.jpeg");
  height: 9rem;
  width: 100%;
  background-repeat: no-repeat;
  background-size: 100%;
  position: relative;
}
.profile-store-detail {
  position: absolute;
  width: 6rem;
  height: 6rem;
  right: 4rem;
  bottom: -2rem;
  border-radius: 100%;
}
.tarjet-product {
  border-radius: 12px;
  margin-bottom: 12px;
  margin-top: 8px;
  margin-left: 7px;
  margin-right: 7px;
  max-width: 400px;
  padding: 1rem;
  box-shadow: 0 10px 16px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
}
.profile-product {
  background-repeat: no-repeat;
  background-size: 100%;
  height: 100%;
  width: 100%;
}
.container-profile-product{
  width: 100px;
  height: 100px;
  margin: auto;

}
.color-pink{
  color:$color_pink
}
</style>
