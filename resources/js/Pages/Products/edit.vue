<template>
    <AppLayout title="Product - Edit">
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 row align-items-center">
                            <div class="col-lg-6">
                                <h6 class="mb-0 h2 text-dark d-inline-block">
                                    Product
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link href="/">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <Link :href="`/product`" class="breadcrumb-text">
                                            Products Management
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            #{{ props.product.code }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
            <div class="mt-4 row">
                <div class="col-lg-2 col-md-2">
                    <div class="nav-wrapper-loc">
                        <ul class="nav nav-pills nav-fill flex-column" id="tabs-icons-text" role="tablist">
                            <li class="mb-2 nav-item">
                                <a class="nav-link active" id="basic-data-tab" data-toggle="tab" href="#basic-data"
                                    role="tab" aria-controls="basic-data" aria-selected="true">
                                    Basic Data</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="image-management-tab" data-toggle="tab" href="#image-management"
                                    role="tab" aria-controls="image-management" aria-selected="true">
                                    Images</a>
                            </li>
                            <li hidden></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10">
                    <div class="shadow card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-data" role="tabpanel">
                                    <EditFormVue :productId="props.product.id" />
                                </div>
                                <div class="tab-pane fade show" id="image-management" role="tabpanel">
                                    <ImagesManagement :productId="props.product.id"  />
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
import EditFormVue from "@/Pages/Products/Components/Basic/EditForm.vue"
import ImagesManagement from "@/Pages/Products/Components/MultipleImages/Images.vue"
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHouse,
    faCircleInfo,
    faCartPlus,
    faDiamond,
} from "@fortawesome/free-solid-svg-icons";



const props = defineProps({
    product: {},
})
 
library.add(faCircleInfo, faCartPlus , faDiamond ,faHouse);

const deleteProduct = async () => {
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
                axios
                    .delete(
                        route("product.basic.delete", data.product.id)
                    )
                    .then((response) => {
                        $inertia.visit(route("product.index"));
                    });
            }
        });
    } catch (error) {
        //data.convertValidationNotification(error);
    }
}
</script>

<style lang="scss" scoped>
.breadcrumb-text {
    color: #6343e9 !important;
}

.nav-link.active {
    background-color: #6343e9 !important;
    color: #fff !important;
}
</style>
