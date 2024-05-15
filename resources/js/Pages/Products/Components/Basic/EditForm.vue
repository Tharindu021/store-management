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
                            v-model="state.edit.code"
                            required
                        />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="brand_id" class="col-md-2 col-form-label">
                        BRANDS
                    </div>
                    <div class="col-md-10">
                        <Multiselect
                            v-model="select_brands"
                            :options="brands"
                            :close-on-select="true"
                            :showLabels="false"
                            :clear-on-select="false"
                            :searchable="true"
                            placeholder="Select Brands"
                            label="name"
                            track-by="id"
                        />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="category_id" class="col-md-2 col-form-label">
                        CATEGORY
                    </div>
                    <div class="col-md-10">
                        <Multiselect
                            v-model="select_category"
                            :options="categories"
                            :close-on-select="true"
                            :showLabels="false"
                            :clear-on-select="false"
                            :searchable="true"
                            placeholder="Select Category"
                            label="name"
                            track-by="id"
                        />
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
                            v-model="state.edit.name"
                            required
                        />
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
                            v-model="state.edit.price"
                            required
                        />
                    </div>
                </div>
                <div class="text-right">
                    <!-- v-if="can('delete_products')" -->
                    <button
                        type="button"
                        class="btn btn-sm btn-round btn-outline-danger mb-0"
                        @click.prevent="deleteProduct"
                    >
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        DELETE
                    </button>
                    <!-- v-if="can('update_products')" -->
                    <button
                        type="submit"
                        class="btn btn-round custom-button btn-sm mb-0"
                    >
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
import {
    faHouse,
    faFloppyDisk,
    faTrash,
} from "@fortawesome/free-solid-svg-icons";
import { onBeforeMount, reactive, ref } from "vue";

library.add(faHouse, faFloppyDisk, faTrash);

const props = defineProps({
    productId: {
        type: Number,
        required: true,
    },
});

const state = reactive({
    edit: {},
});

const select_brands = ref(null);
const select_category = ref(null);
const brands = ref([]);
const categories = ref([]);

onBeforeMount(() => {
    getCategorytData();
    getBrandData();
    getProduct();
});

const getProduct = async () => {
    const products = (await axios.get(route("product.get", props.productId)))
        .data;
    state.edit = products;
    const select_brands = (
        await axios.get(route("brand.get", state.edit.brand_id))
    ).data;
    select_brands.value = select_brands;
    const select_category = (
        await axios.get(route("category.get", state.edit.category_id))
    ).data;
    select_category.value = select_category;
};

const getBrandData = async () => {
    try {
        const response = (await axios.get(route("brand.all"))).data;
        brands.value = response.data;
    } catch (error) {
        console.error("Error fetching Brands data:", error);
    }
};

const getCategorytData = async () => {
    try {
        const response = (await axios.get(route("category.all"))).data;
        categories.value = response.data;
    } catch (error) {
        console.error("Error fetching Category data:", error);
    }
};

const updateBasicData = async () => {
    try {
        if (select_brands.value) {
            state.edit.brand_id = select_brands.value.id;
        }
        if (select_category.value) {
            state.edit.category_id = select_category.value.id;
        }
        console.log(state.edit);
        await axios.post(
            route("products.basic.update", props.productId),
            state.edit
        );
        Swal.fire({
            title: "Products updated successfully",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#6CA925", // Green,
        });
    } catch (error) {
        //convertValidationError(error);
    }
};

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
                    .delete(route("products.basic.delete", state.edit.id))
                    .then((response) => {
                        router.visit(route("product.index"));
                    });
            }
        });
    } catch (error) {
        //convertValidationNotification(error);
    }
};
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
