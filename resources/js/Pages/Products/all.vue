<template>
    <AppLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">Products</h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                             Products Management
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-4 text-right" >
                                <a href="javascript:void(0)" @click.prevent="newVendor"
                                    class="btn btn-sm btn-neutral float-end">
                                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                                    ADD NEW
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #content>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="row my-3 mx-2">
                            <!-- <div class="col-md-2 column__right___padding">
                                <div for="purchase_uom" class="col-form-label">CODE</div>
                                <input type="text" class="form-control form-control-sm" name="code" id="code"
                                    v-model="search_product.code" placeholder="Code" @keyup="getSearch" />
                            </div>
                            <div class="col-md-2 column__right___padding column__left___padding">
                                <div for="purchase_uom" class="col-form-label">NAME</div>
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    v-model="search_product.name" placeholder="Product Name" @keyup="getSearch" />
                            </div>
                            <div class="col-md-2 column__left___padding column__right___padding">
                                <div for="purchase_uom" class="col-form-label">COUNTRY</div>
                                <Multiselect v-model="data.select_search_brand" :options="brands" class="z__index"
                                    :showLabels="false" :close-on-select="true" :clear-on-select="false" :searchable="true"
                                    placeholder="Select Brand" label="name" track-by="id" />
                            </div>
                            <div class="col-md-2 column__left___padding column__right___padding">
                                <div for="purchase_uom" class="col-form-label">CURRENCY</div>
                                <Multiselect v-model="this.select_search_category" :options="categories" class="z__index"
                                    :showLabels="false" :close-on-select="true" :clear-on-select="false" :searchable="true"
                                    placeholder="Select Category" label="name" track-by="id" />
                            </div> -->
                            <div class="col-md-2 mt-4 column__left___padding">
                                <a href="javascript:void(0)" @click.prevent="clearFilters"
                                    class="btn btn-sm btn-ash float-end mt-2 pt-2">
                                    CLEAR
                                </a>
                            </div>
                            <div class="text-muted ml-auto mx-4 mt-4">
                                <div class="inline-block">
                                    <select class="form-control form-control-sm per-page-entry mt-2" :value="100"
                                        v-model="pageCount" @change="perPageChange" name="PageData" id="pageData">
                                        <option v-for="perPageCount in perPage" :key="perPageCount" :value="perPageCount"
                                            v-text="perPageCount" />
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-4">
                            <div class="table-responsive">
                                <div class="d-flex flex-row mb-3 rounded">
                                    <div class="left d-flex">
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-clone"
                                                color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon"
                                                icon="fa-solid fa-arrow-up-from-bracket" color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-cloud-arrow-down"
                                                color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-wrench"
                                                rotation="{270}" color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item" >
                                            <!-- <a @click.prevent="
                                                activeSelectedItems(checkMatirialTypeItems)
                                                v-if="can('active_types')"
                                                "> -->
                                            <a>
                                                <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-circle-check"
                                                    color="#0bd018" />
                                            </a>
                                        </div>
                                        <div class="p-2 border icon_item" >

                                            <!-- <a @click.prevent="
                                                inactiveSelectedItems(checkMatirialTypeItems)
                                                v-if="can('inactive_types')" 
                                                "> -->
                                            <a>
                                                <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-circle-minus"
                                                    color="#eb0505" />
                                            </a>
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <!-- v-if="can('delete_types') && this.checkMatirialTypeItems.length > 0" -->
                                            <!-- <a href="javascript:void(0)" @click.prevent="
                                                deleteSelectedItems(checkMatirialTypeItems)
                                                "> -->
                                            <a>
                                                <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-trash"
                                                    color="#eb0505" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="right d-flex ml-auto">
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-print"
                                                color="#505050" />
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th  class="checkArea">
                                                <!-- <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox" @click="selectAll"
                                                    v-if="data.product.length > 0" :checked="data.checkAllItems.length==this.checkProductItems.length"  v-model="checkAllItems" />
                                                </div> -->
                                            </th>
                                            <th :class="data.textClassHead">Code</th>
                                            <th :class="data.textClassHead">Brand Name</th>
                                            <th :class="data.textClassHead">Category Name</th>
                                            <th :class="data.textClassHead">Name</th>
                                            <th :class="data.textClassHead">Status</th>
                                            <th :class="data.textClassHead"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  v-for=" products in data.product" :key="products.id" :class="data.rowClass">
                                            <td class="checkArea">
                                                <!-- <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox"
                                                        v-model="checkProductItems" v-bind:value="products"
                                                        v-bind:id="products.id" />
                                                </div> -->
                                            </td>
                                            <td :class="data.textClassBody">
                                                {{ products.code }}
                                            </td>
                                            <td :class="data.textClassBody">
                                                {{ products.brand_name }}
                                            </td>
                                            <td :class="data.textClassBody">
                                                {{ products.category_name }}
                                            </td>
                                            <td :class="data.textClassBody">
                                                {{ products.name }}
                                            </td>
                                            <td>
                                                <span v-if="products.status == 1"
                                                    class="badge bg-success text-white fw-bold ml-3">Active</span>
                                                <span v-if="products.status == 0"
                                                    class="badge bg-warning text-white fw-bold ml-3">Deactive</span>
                                            </td>
                                            <td :class="data.iconClassBody">
                                                <a type="button" class="p-2" href="javascript:void(0)"
                                                    >
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="flex mt-1 mx-1 px-3 card-footer table-footer align-items-center">
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_info column__left___padding" id="DataTables_Table_0_info"
                                    role="status" aria-live="polite">
                                    Showing {{ data.pagination.from }} to {{ data.pagination.to }} of
                                    {{ data.pagination.total }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_paginate paging_simple_numbers column__right___padding"
                                    id="DataTables_Table_0_paginate">
                                    <nav aria-label="Page navigation" style="float: right">
                                        <ul class="pagination">
                                            <li class="page-item" :class="data.pagination.current_page == 1 ? 'disabled' : ''">
                                                <a class="page-link" href="javascript:void(0)"
                                                    @click="setPage(data.pagination.current_page - 1)">
                                                    <i class="fa-solid fa-angles-left"></i>
                                                </a>
                                            </li>
                                            <template v-for="(page, index) in data.pagination.last_page">
                                                <template v-if="page == 1 ||
                                                    page == data.pagination.last_page ||
                                                    Math.abs(page - data.pagination.current_page) < 5
                                                    ">
                                                    <li class="page-item" :key="index" :class="data.pagination.current_page == page ? 'active' : ''
                                                        ">
                                                        <a class="page-link" @click="setPage(page)">{{
                                                            page
                                                        }}</a>
                                                    </li>
                                                </template>
                                            </template>
                                            <li class="page-item" :class="data.pagination.current_page == data.pagination.last_page
                                                    ? 'disabled'
                                                    : ''
                                                ">
                                                <a class="page-link" href="javascript:void(0)"
                                                    @click="setPage(data.pagination.current_page + 1)">
                                                    <i class="fa-solid fa-angles-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #modals>
            <div class="modal fade" id="newProductModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newProductModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_productLabel">
                                New product
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <font-awesome-icon icon="fa-solid fa-xmark" />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body m-2">
                                    <form role="form text-left" @submit.prevent="createProduct"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label col-form-label">
                                                NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    v-model="data.products.name" id="name" placeholder="Name" required />
                                                    <!-- <small v-if="validationErrors.message" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">
                                                    {{validationErrors.message}}
                                                </small> -->
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label col-form-label">
                                                CODE
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="slug"
                                                    v-model="data.products.code" id="code" placeholder="Code" required />
                                                    <!-- <small v-if="validationErrors.message" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.message}}
                                                        </small> -->
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="country_id" class="col-md-3 col-form-label">
                                                BRAND
                                            </div>
                                            <div class="col-md-9">
                                                <Multiselect v-model="data.select_brand" :options="data.brands"
                                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                                    :searchable="true" placeholder="Select Brand" label="name" name="brand" id="brand"
                                                    track-by="id" />

                                                <!-- <small v-if="validationErrors.country_id" id="msg_country_id"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.country_id }}</small> -->
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="currency_id" class="col-md-3 col-form-label">
                                                CATEGORY
                                            </div>
                                            <div class="col-md-9">
                                                 <Multiselect v-model="data.select_category" :options="data.categories"
                                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                                    :searchable="true" placeholder="Select Category" label="name" id="category" name="category"                                                    track-by="id" />
                                                <!-- <small v-if="validationErrors.currency_id" id="msg_currency_id"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.currency_id }}</small> -->
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="submit" class="btn btn-round btn-outline--info btn-sm mb-0">
                                                <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                                                CREATE
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { reactive } from 'vue';
import AppLayout from '../../Layouts/AppLayout.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { onBeforeMount , watch} from 'vue';
import axios from 'axios';
import Multiselect from "vue-multiselect";
import { faHouse,faFloppyDisk,faCirclePlus,faClone,faCloudArrowDown,faSquarePlus,faPrint,faWrench,faCircleCheck,faCircleMinus,faTrash,faArrowUpFromBracket,faXmark,faPenToSquare,faPen, } from '@fortawesome/free-solid-svg-icons'


library.add(
    faHouse,
    faFloppyDisk,
    faCirclePlus,
    faClone,
    faCloudArrowDown,
    faSquarePlus,
    faPrint,
    faWrench,
    faCircleCheck,
    faCircleMinus,
    faTrash,
    faArrowUpFromBracket,
    faXmark,
    faPenToSquare,
    faPen,);

const data = reactive({
    textClassHead: "text-start text-uppercase",
    textClassBody: "text-start",
    iconClassHead: "text-right",
    iconClassBody: "text-right",
    rowClass: "cursor-pointer",

    search: null,
    search_product: {},
    select_search_brand: null,
    select_search_category:  null,
    brands: [],
    categories: [],

    page: 1,
    perPage: [25, 50, 100],
    pageCount: 25,
    pagination: {},

    select_brand: null,
    select_category: null,
    products: {},
    product: [],
    edit_product: {},

    checkAllItems:false,
    checkProductItems: [],
});

onBeforeMount(() => {
    getProductData();
    getBrandData();
    getCategorytData();
    reload();
})

watch(() => data.checkAllItems,(newX,oldX) => {
    data.products.forEach((item, index) => {
        if (index !== 0) {
            item.selected = newX;
        }
    });
    if (data.checkProductItems.length == data.products.length) {
        data.checkProductItems = [];
    } else {
        data.checkProductItems = data.products;
    }
})

watch(() => data.checkProductItems,(newX,oldX) => {
    if (newX.length != data.products.length) {
        data.checkAllItems = false;
    }
})

watch(() =>data.select_search_brand,(newX,oldX)=>{
        data.search_product.brand = newX ? newX.id : null;
    // getSearch();

})

watch(() =>data.select_search_category,(newX,oldX)=>{
        data.search_product.category = newX ? newX.id : null;
    //getSearch();
})

const setPage = async (page) =>  {
            data.page = page;
            reload();
}

const getSearch = async () => {
    data.page = 1;
    reload();
}

const perPageChange = async () => {
    reload();
}

const clearFilters = async () => {
    data.select_search_brand = null;
    data.select_search_category = null;
    data.search_product = {};
    //this.reload();
}



const reload = async () => {
    try {
        const res = await axios.get(route("product.all", {
            params: {
                page: data.page,
                per_page: data.pageCount,
                "filter[search]": data.search,
                search_product_code: data.search_product.code,
                search_product_name: data.search_product.name,
                search_product_brand: data.search_product.brand,
                search_product_category: data.search_product.category,
            },
        })).data;
        console.log("Successs");
        data.product = res.data;
        data.pagination = res.meta;
    } catch (error) {
        console.error('Error reloading product data:', error);
    }
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

const getProductData = async () => {
    try {
        const res = (await axios.get(route("product.all"))).data;
        data.product = res.data;
        data.pagination = res.meta;
    } catch (error) {
        console.error('Error fetching product data:', error);
    }

}

const createProduct = async () => {
    // resetValidationErrors();
    try{
        if (data.select_brand) {
            data.products.brand_id = data.select_brand.id;
        }
        if (data.select_category) {
            data.products.category_id = data.select_category.id;
        }
        const vendor = (await axios.post(route("product.store"), data.products)).data;
        //window.location.href = route("vendors.edit", vendor.id);
        $("#newProductModal").modal("hide");
        data.products = {};
        data.select_brand = {};
        data.select_category = {};
        //getProductData();
        // this.$root.notify.success({
        //     title: "Success",
        //     message: "Vendor created successfully",
        // });
        reload();
    } catch (error){
        console.error('Error store product data:', error);
    }
}

const editProduct = async (id) => {
    //window.location.href = route("vendors.edit", vendorId);
}

const newVendor = () => {
           // this.$root.loader.start();
            data.select_category = null;
            data.select_brand = null;
            data.products = {};
            $("#newProductModal").modal("show");
            //this.$root.loader.finish();
}

const deleteProduct = async (id) => {
    try {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202",
            cancelButtonColor: "#6CA925",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(route("product.delete", id));
                reload();
                Swal.fire("Deleted!", `Record has been deleted.`, "success");
            }
        });
    } catch (error) {
        convertValidationNotification(error);
    }
}

const selectAll = (event) => {
    if (event.target.checked == false) {
        checkAllItems = [];
    } else {
        data.product.forEach((products) => {
            data.checkProductItems.push(products.id);
        });
    }
}

const deleteSelectedItems = async (checkProductItems) => {
    //this.$root.loader.start();
    try {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202", // Green
            cancelButtonColor: "#6CA925", // Secondary Color
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                const ids = checkProductItems.map((products) => data.products.id);
                axios.post(route("product.delete.selected", data.checkProductItems),{ ids })
                .then((response) => {
                        // this.reload();
                        console.log('Items deleted successfully.')
                    });
            }
        });
        this.$root.loader.finish();
    } catch (error) {
        this.convertValidationNotification(error);
    }
}

const inactiveSelectedItems = async (checkProductItems) =>{
    //this.$root.loader.start();
    const ids = checkProductItems.map((products) => data.products.id
    );
    axios.post(route("product.inactive.selected"), { ids })
        .then((response) => {this.checkProductItems = [];
            // this.reload();
        });
        //this.$root.loader.finish();     
}

const activeSelectedItems = async (checkProductItems) => {
    //this.$root.loader.start();
    const ids = checkProductItems.map((products) => data.products.id
    );
    axios.post(route("product.active.selected"), { ids })
        .then((response) => {
            data.checkProductItems = [];
            // this.reload();
        });
    //this.$root.loader.finish();
}

</script>

<style lang="scss" scoped></style>