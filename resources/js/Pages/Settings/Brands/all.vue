<template>
    <AppLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">
                                    Brands
                                </h6>
                                <nav
                                    aria-label="breadcrumb"
                                    class="d-none d-md-block"
                                >
                                    <ol
                                        class="breadcrumb breadcrumb-links breadcrumb-dark"
                                    >
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                                <font-awesome-icon
                                                    icon="fa-solid fa-house"
                                                    color="#505050"
                                                />
                                            </Link>
                                        </li>
                                        <li
                                            class="breadcrumb-item active breadcrumb-text"
                                            aria-current="page"
                                        >
                                            Brands Management
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-4 text-right">
                                <a
                                    href="javascript:void(0)"
                                    data-toggle="modal"
                                    data-target="#newBrandModal"
                                    class="btn btn-sm btn-neutral float-end"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle-plus"
                                    />
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
                        <div class="py-3 mx-3 text-sm card-body">
                            <div class="flex">
                                <div class="flex items-center text-muted">
                                    Search:
                                    <div class="inline-block ml-2">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            v-model="data.search"
                                            @keyup="getSearch"
                                        />
                                    </div>
                                </div>
                                <div class="flex text-muted ml-auto mx-2">
                                    <div class="inline-block mx-1">
                                        <select
                                            class="form-control form-control-sm per-page-entry"
                                            :value="25"
                                            v-model="data.pageCount"
                                            @change="data.perPageChange"
                                        >
                                            <option
                                                v-for="perPageCount in data.perPage"
                                                :key="perPageCount"
                                                :value="perPageCount"
                                                v-text="perPageCount"
                                            />
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-4">
                            <div class="table-responsive">
                                <div class="d-flex flex-row mb-3 rounded">
                                    <div class="left d-flex">
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon
                                                class="icon_item-icon"
                                                icon="fa-solid fa-clone"
                                                color="#505050"
                                            />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon
                                                class="icon_item-icon"
                                                icon="fa-solid fa-arrow-up-from-bracket"
                                                color="#505050"
                                            />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon
                                                class="icon_item-icon"
                                                icon="fa-solid fa-cloud-arrow-down"
                                                color="#505050"
                                            />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon
                                                class="icon_item-icon"
                                                icon="fa-solid fa-wrench"
                                                rotation="{270}"
                                                color="#505050"
                                            />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <!-- v-if="can('active_types')" -->
                                            <a
                                                @click.prevent="
                                                    activeSelectedItems(
                                                        data.checkBrandItems
                                                    )
                                                "
                                            >
                                                <font-awesome-icon
                                                    class="icon_item-icon"
                                                    icon="fa-solid fa-circle-check"
                                                    color="#0bd018"
                                                />
                                            </a>
                                        </div>
                                        <div class="p-2 border icon_item" >
                                            <!-- v-if="can('inactive_types')" -->
                                            <a
                                                @click.prevent="
                                                    inactiveSelectedItems(
                                                        data.checkBrandItems
                                                    )
                                                "
                                            >
                                                <font-awesome-icon
                                                    class="icon_item-icon"
                                                    icon="fa-solid fa-circle-minus"
                                                    color="#eb0505"
                                                />
                                            </a>
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <!-- v-if="can('delete_types') && this.checkMatirialTypeItems.length > 0" -->
                                            <a
                                                href="javascript:void(0)"
                                                @click.prevent="
                                                    deleteSelectedItems(
                                                        data.checkBrandItems
                                                    )
                                                "
                                            >
                                                <font-awesome-icon
                                                    class="icon_item-icon"
                                                    icon="fa-solid fa-trash"
                                                    color="#eb0505"
                                                />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="right d-flex ml-auto">
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon
                                                class="icon_item-icon"
                                                icon="fa-solid fa-print"
                                                color="#505050"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="checkArea">
                                                <!-- ----------------------------------------------------------------- -->
                                                <div class="form-check mb-4">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        @click="selectAll"
                                                        v-if="
                                                            data.brand.length >
                                                            0
                                                        "
                                                        :checked="
                                                            data.checkAllItems
                                                                .length ==
                                                            data.checkBrandItems
                                                                .length
                                                        "
                                                        v-model="
                                                            data.checkAllItems
                                                        "
                                                    />
                                                </div>
                                            </th>
                                            <th :class="data.textClassHead">
                                                Name
                                            </th>
                                            <th :class="data.textClassHead">
                                                Slug
                                            </th>
                                            <th :class="data.textClassHead">
                                                Status
                                            </th>
                                            <th
                                                :class="data.textClassHead"
                                            ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="brands in data.brand"
                                            :key="brands.id"
                                            :class="data.rowClass"
                                        >
                                            <td class="checkArea">
                                                <div class="form-check mb-4">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        v-model="
                                                            data.checkBrandItems
                                                        "
                                                        v-bind:value="brands"
                                                        v-bind:id="brands.id"
                                                    />
                                                </div>
                                            </td>
                                            <td :class="data.textClassBody">
                                                {{ brands.name }}
                                            </td>
                                            <td :class="data.textClassBody">
                                                {{ brands.slug }}
                                            </td>
                                            <td>
                                                <span
                                                    v-if="brands.status == 1"
                                                    class="badge bg-success text-white fw-bold ml-3"
                                                    >Active</span
                                                >
                                                <span
                                                    v-if="brands.status == 0"
                                                    class="badge bg-warning text-white fw-bold ml-3"
                                                    >Deactive</span
                                                >
                                            </td>
                                            <td :class="data.iconClassBody">
                                                <a
                                                    type="button"
                                                    class="p-2"
                                                    href="javascript:void(0)"
                                                    @click.prevent="
                                                        editBrand(brands.id)
                                                    "
                                                >
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a
                                                    type="button"
                                                    class="p-2 float-end"
                                                    href="javascript:void(0)"
                                                    @click.prevent="
                                                        deleteBrand(brands.id)
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            class="flex mt-1 mx-1 px-3 card-footer table-footer align-items-center"
                        >
                            <div class="col-sm-12 col-md-6 p-0">
                                <div
                                    class="dataTables_info column__left___padding"
                                    id="DataTables_Table_0_info"
                                    role="status"
                                    aria-live="polite"
                                >
                                    Showing {{ data.pagination.from }} to
                                    {{ data.pagination.to }} of
                                    {{ data.pagination.total }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 p-0">
                                <div
                                    class="dataTables_paginate paging_simple_numbers column__right___padding"
                                    id="DataTables_Table_0_paginate"
                                >
                                    <nav
                                        aria-label="Page navigation"
                                        style="float: right"
                                    >
                                        <ul class="pagination">
                                            <li
                                                class="page-item"
                                                :class="
                                                    data.pagination
                                                        .current_page == 1
                                                        ? 'disabled'
                                                        : ''
                                                "
                                            >
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0)"
                                                    @click="
                                                        setPage(
                                                            data.pagination
                                                                .current_page -
                                                                1
                                                        )
                                                    "
                                                >
                                                    <i
                                                        class="fa-solid fa-angles-left"
                                                    ></i>
                                                </a>
                                            </li>
                                            <template
                                                v-for="(page, index) in data
                                                    .pagination.last_page"
                                            >
                                                <template
                                                    v-if="
                                                        page == 1 ||
                                                        page ==
                                                            data.pagination
                                                                .last_page ||
                                                        Math.abs(
                                                            page -
                                                                data.pagination
                                                                    .current_page
                                                        ) < 5
                                                    "
                                                >
                                                    <li
                                                        class="page-item"
                                                        :key="index"
                                                        :class="
                                                            data.pagination
                                                                .current_page ==
                                                            page
                                                                ? 'active'
                                                                : ''
                                                        "
                                                    >
                                                        <a
                                                            class="page-link"
                                                            @click="
                                                                setPage(page)
                                                            "
                                                            >{{ page }}</a
                                                        >
                                                    </li>
                                                </template>
                                            </template>
                                            <li
                                                class="page-item"
                                                :class="
                                                    data.pagination
                                                        .current_page ==
                                                    data.pagination.last_page
                                                        ? 'disabled'
                                                        : ''
                                                "
                                            >
                                                <a
                                                    class="page-link"
                                                    href="javascript:void(0)"
                                                    @click="
                                                        setPage(
                                                            data.pagination
                                                                .current_page +
                                                                1
                                                        )
                                                    "
                                                >
                                                    <i
                                                        class="fa-solid fa-angles-right"
                                                    ></i>
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
            <div
                class="modal fade"
                id="newBrandModal"
                data-backdrop="static"
                tabindex="-1"
                role="dialog"
                aria-labelledby="newBrandModal"
                aria-hidden="true"
            >
                <div
                    class="modal-dialog modal-dialog-centered modal-sm"
                    role="document"
                >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title font-weight-bolder text-info text-gradient"
                                id="add_brandLabel"
                            >
                                New brand
                            </h5>
                            <button
                                type="button"
                                class="close btn"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">
                                    <font-awesome-icon
                                        icon="fa-solid fa-xmark"
                                    />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body m-2">
                                    <form
                                        role="form text-left"
                                        @submit.prevent="createBrand"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="row mb-1">
                                            <div
                                                for="name"
                                                class="col-md-3 col-form-label col-form-label"
                                            >
                                                NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    name="name"
                                                    v-model="data.brands.name"
                                                    id="name"
                                                    placeholder="Name"
                                                    required
                                                />
                                                <small v-if="data.validationErrors.message" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">
                                                    {{data.validationErrors.message}}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div
                                                for="code"
                                                class="col-md-3 col-form-label col-form-label"
                                            >
                                                SLUG
                                            </div>
                                            <div class="col-md-9">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    name="slug"
                                                    v-model="data.brands.slug"
                                                    id="slug"
                                                    placeholder="Slug"
                                                    required
                                                />
                                                <small v-if="data.validationErrors.message" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        data.validationErrors.message}}
                                                        </small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button
                                                type="submit"
                                                class="btn btn-round btn-outline--info btn-sm mb-0"
                                            >
                                                <font-awesome-icon
                                                    icon="fa-solid fa-floppy-disk"
                                                />
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
            <div
                class="modal fade"
                id="editBrandModal"
                data-backdrop="static"
                tabindex="-1"
                role="dialog"
                aria-labelledby="editBrandModal"
                aria-hidden="true"
            >
                <div
                    class="modal-dialog modal-dialog-centered modal-sm"
                    role="document"
                >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title font-weight-bolder text-info text-gradient"
                                id="add_brandLabel"
                            >
                                Update brand
                            </h5>
                            <button
                                type="button"
                                class="close btn"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">
                                    <font-awesome-icon
                                        icon="fa-solid fa-xmark"
                                    />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body m-2">
                                    <form
                                        @submit.prevent="updateBrands()"
                                        role="form text-left"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="row mb-1">
                                            <div
                                                for="name"
                                                class="col-md-3 col-form-label col-form-label"
                                            >
                                                NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input
                                                    v-model="
                                                        data.edit_brand.name
                                                    "
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    name="name"
                                                    id="name"
                                                    placeholder="Name"
                                                    required
                                                />
                                                <small v-if="data.validationErrors.message" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        data.validationErrors.message
                                                    }}</small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div
                                                for="code"
                                                class="col-md-3 col-form-label col-form-label"
                                            >
                                                SLUG
                                            </div>
                                            <div class="col-md-9">
                                                <input
                                                    v-model="
                                                        data.edit_brand.slug
                                                    "
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    name="slug"
                                                    id="slug"
                                                    placeholder="Slug"
                                                    required
                                                />
                                                <small v-if="data.validationErrors.message" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        data.validationErrors.message
                                                    }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button
                                                type="submit"
                                                class="btn btn-round btn-outline--info btn-sm mb-0"
                                            >
                                                <font-awesome-icon
                                                    icon="fa-solid fa-floppy-disk"
                                                />
                                                Update
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
import { reactive } from "vue";
import AppLayout from "../../../Layouts/AppLayout.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { onBeforeMount, watch } from "vue";
import axios from "axios";
import {
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
    faPen,
} from "@fortawesome/free-solid-svg-icons";

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
    faPen
);

const data = reactive({
    textClassHead: "text-start text-uppercase",
    textClassBody: "text-start",
    iconClassHead: "text-right",
    iconClassBody: "text-right",
    rowClass: "cursor-pointer",
    search: null,
    page: 1,
    perPage: [25, 50, 100],
    pageCount: 25,
    pagination: {},
    brands: {},
    brand: [],
    edit_brand: {},
    checkAllItems: false,
    checkBrandItems: [],
    validationErrors: {}
});

onBeforeMount(() => {
    getBrandData();
});

watch(
    () => data.checkAllItems,(newX,oldX) => {
    data.brands.forEach((item, index) => {
        if (index !== 0) {
            item.selected = newX;
        }
    });
    if (data.checkBrandItems.length == data.brands.length) {
        data.checkBrandItems = [];
    } else {
        data.checkBrandItems = data.brands;
    }
})

watch(
    () => data.checkBrandItems,(newX,oldX) => {
    if (data.checkBrandItems.length != data.brands.length) {
        data.checkAllItems = false;
    }
})

const setPage = async (page) => {
    data.page = page;
    reload();
};

const getSearch = async () => {
    data.page = 1;
    reload();
};

const perPageChange = async () => {
    reload();
};

const resetValidationErrors = () => {
    data.validationErrors = []
}

const convertValidationNotification = (error) =>{
    data.validationErrors.message = error.message;
}

const reload = async () => {
    try {
        const res = (await axios.get(route("brand.all"),{
            params: {
                    page: data.page,
                    per_page: data.pageCount,
                    "filter[search]": data.search,
                },
        })).data;
        data.brand = res.data;
        data.pagination = res.meta;
    } catch (error) {
        console.log("Error reloading brand data:", error);
    }
};

const getBrandData = async () => {
    try {
        const res = (await axios.get(route("brand.all"))).data;
        data.brand = res.data;
        data.pagination = res.meta;
    } catch (error) {
        console.log("Error fetching brand data:", error);
    }
};

const createBrand = async () => {
    resetValidationErrors();
    try {
        await axios.post(route("brand.store"), data.brands);
        $("#newBrandModal").modal("hide");
        data.brands = {};
        $("#newBrandModal").modal("hide");
        reload();
    } catch (error) {
        convertValidationNotification(error);
    }
};

const editBrand = async (id) => {
    resetValidationErrors();
    try {
        console.log(id);
        const edit_brand = await axios.get(route("brand.get", id));
        data.edit_brand = edit_brand.data;
        $("#editBrandModal").modal("show");
    } catch (error) {
        convertValidationNotification(error);
    }
};

const updateBrands = async (id) => {
    resetValidationErrors();
    try {
        await axios.post(
            route("brand.update", data.edit_brand.id),
            data.edit_brand
        );
        reload();
        $("#editBrandModal").modal("hide");
        data.edit_brand = {};
        $root.notify.success({
            title: "Success",
            message: "Brand is updated successfully",
        });
    } catch (error) {
        convertValidationNotification(error)
    }
};


const deleteBrand = async (id) => {
    //console.log(id);
    try {
        Swa.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202",
            cancelButtonColor: "#6CA925",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(route("brand.delete", id));
                reload();
                Swal.fire("Deleted!", `Record has been deleted.`, "success");
            }
        });
    } catch (error) {
        convertValidationNotification(error);
    }
};

const selectAll = (event) => {
    if (event.target.checked == false) {
        checkAllItems = [];
    } else {
        data.brand.forEach((brands) => {
            data.checkBrandItems.push(brands.id);
        });
    }
};

const deleteSelectedItems = async (checkBrandItems) => {
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
                // console.log(data.checkBrandItems.data);
                const ids = data.checkBrandItems.map(
                    (brands) => brands.id
                );
                console.log(ids);
                axios
                    .post(
                        route("brand.delete.selected", data.checkBrandItems),
                        { ids }
                    )
                    .then((response) => {
                        reload();
                        console.log("Items deleted successfully.");
                    });
            }
        });
    } catch (error) {
        convertValidationNotification(error);
    }
};

const inactiveSelectedItems = async (checkBrandItems) => {
    const ids = data.checkBrandItems.map((brands) => brands.id);
    axios.post(route("brand.inactive.selected"), { ids }).then((response) => {
        data.checkBrandItems = [];
        reload();
    });
};

const activeSelectedItems = async (checkMatirialTypeItems) => {
    const ids = data.checkBrandItems.map((brands) => brands.id);
    axios.post(route("brand.active.selected"), { ids }).then((response) => {
        data.checkBrandItems = [];
        reload();
    });
};
</script>

<style lang="scss" scoped></style>
