<template>
  <div id="basic-info">
    <div class="card-header">
      <h5>Basic Info</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form
        role="form text-left"
        @submit.prevent="updateBasicData"
        enctype="multipart/form-data"
      >
        <div class="row mb-1">
          <div for="code" class="col-md-2 col-form-label">CODE</div>
          <div class="col-md-10">
            <input
              type="text"
              class="form-control form-control-sm"
              name="code"
              id="code"
              v-model="data.products.code"
              required
            />
            <!-- <small
              v-if="validationErrors.code"
              id="msg_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.code }}</small
            > -->
          </div>
        </div>
        <div class="row mb-1">
          <div for="brand_id" class="col-md-2 col-form-label">BRANDS</div>
          <div class="col-md-10">
            <Multiselect
              v-model="data.select_brands"
              :options="data.brands"
              :close-on-select="true"
              :showLabels="false"
              :clear-on-select="false"
              :searchable="true"
              placeholder="Select Brands"
              label="name"
              track-by="id"
            />
            <!-- <small
              v-if="validationErrors.brand_id"
              id="msg_brand_id"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.brand_id }}</small
            > -->
          </div>
        </div>
        <div class="row mb-1">
          <div for="category_id" class="col-md-2 col-form-label">CATEGORY</div>
          <div class="col-md-10">
            <Multiselect
              v-model="data.select_category"
              :options="data.categories"
              :close-on-select="true"
              :showLabels="false"
              :clear-on-select="false"
              :searchable="true"
              placeholder="Select Category"
              label="name"
              track-by="id"
            />
            <!-- <small
              v-if="validationErrors.category_id"
              id="msg_category_id"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.category_id }}</small
            > -->
          </div>
        </div>
        <div class="row mb-1">
          <div for="name" class="col-md-2 col-form-label">NAME</div>
          <div class="col-md-10">
            <input
              type="text"
              class="form-control form-control-sm"
              name="name"
              id="name"
              v-model="data.products.name"
              required
            />
            <!-- <small
              v-if="validationErrors.name"
              id="msg_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.name }}</small
            > -->
          </div>
        </div>
        <div class="row mb-1">
          <div for="name" class="col-md-2 col-form-label">PRICE</div>
          <div class="col-md-10">
            <input
              type="text"
              class="form-control form-control-sm"
              name="name"
              id="name"
              v-model="data.products.price"
              required
            />
            <!-- <small
              v-if="validationErrors.name"
              id="msg_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.name }}</small
            > -->
          </div>
        </div>
        <div class="text-right">
          <!-- v-if="can('delete_products')" -->
          <button
            type="button"
            class="btn btn-sm btn-round btn-outline-danger mb-0"
            @click.prevent="deleteProduct">
            <font-awesome-icon icon="fa-solid fa-trash" />
            DELETE
          </button>
          <!-- v-if="can('update_products')" -->
          <button type="submit" class="btn btn-round custom-button btn-sm mb-0">
            <font-awesome-icon icon="fa-solid fa-floppy-disk" />
            SAVE
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>

import { Link, router } from "@inertiajs/vue3";
import Multiselect from "vue-multiselect";
import Swal from "sweetalert2";
import { library } from "@fortawesome/fontawesome-svg-core";
import {faHouse, faFloppyDisk, faTrash} from "@fortawesome/free-solid-svg-icons";
import { onBeforeMount, reactive } from "vue";

library.add(faHouse , faFloppyDisk , faTrash);

const props = defineProps({
  productId: {
    type: Number,
    required: true,
  },
})
 
const data = reactive({
  products: {},
  select_brands: null,
  select_category: null,
  brands: [],
  categories: [],
})

onBeforeMount(() => {
    console.log("Before Mount");
    getCategorytData();
    getBrandData();
    getProduct();
})

const getProduct = async () => {
    // data.$nextTick(() => {
    //   //$root.loader.start();
    // });
    const products = (await axios.get(route("product.get", props.productId))).data;
    data.products = products;
    const select_brands = (
    await axios.get(route("brand.get", data.products.brand_id))).data;
    data.select_brands = select_brands;

    const select_category = (
    await axios.get(route("category.get", data.products.category_id))).data;
    data.select_category = select_category;
    // data.$nextTick(() => {
    //   //$root.loader.finish();
    // });
}

const getBrandData = async () => {
    try {
        const res = (await axios.get(route("brand.all"))).data;
        data.brands = res.data;
    } catch (error) {
        console.error('Error fetching Brands data:', error);
    }
}

const getCategorytData = async () => {
    try {
        const res = (await axios.get(route("category.all"))).data;
        data.categories = res.data;
    } catch (error) {
        console.error('Error fetching Category data:', error);
    }
}

const updateBasicData = async () => {
    //data.resetValidationErrors();
    try {
      if (data.select_brands) {
        data.products.brand_id = data.select_brands.id;
      }
      if (data.select_category) {
        data.products.category_id = data.select_category.id;
      }
      await axios.post(
        route("products.basic.update", props.productId),
        data.products
      );
      Swal.fire({
        title: "Products updated successfully",
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#6CA925", // Green,
      })
      // data.$root.notify.success({
      //   title: "Success",
      //   message: "Products updated successfully",
      // });
    } catch (error) {
      //data.convertValidationError(error);
    }
}

const deleteProduct = async () => {
    try {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#C00202", // Green
        cancelButtonColor: "#6CA925", // Secondary Color
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(route("products.basic.delete", data.products.id))
            .then((response) => {
              router.visit(route("product.index"));
            });
        }
      });
    } catch (error) {
      //data.convertValidationNotification(error);
    }
}
</script>

<style lang="scss" scoped>

.custom-button {
  background-color: #ffffff;
  border-color: #6343e9;
  color: #6343e9 !important;
}
.custom-button:hover {
  background-color: #6343e9;
  color: #ffffff !important;
}
</style>
