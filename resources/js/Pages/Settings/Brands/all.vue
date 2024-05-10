<template>
    <AppLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            / Brands
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- @click.prevent="editvehicle(vehicle.id)" -->
                            <div class="col-lg-4 text-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#newBrandModal"
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
            <div class="row mx-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <!-- {{ brands.name }} -->21
                                </td>
                                <td>
                                    <!-- {{ brands.code }} -->32
                                </td>
                                <td>
                                    <!-- <span v-if="brand.status == 1"
                                        class="badge bg-success text-white fw-bold ml-3">Active</span>
                                    <span v-if="vehicle.status == 0"
                                        class="badge bg-warning text-white fw-bold ml-3">Deactive</span> -->staus
                                </td>
                                <td>
                                    <a type="button" class="p-2" href="javascript:void(0)" @click.prevent="editBrand()">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a type="button" class="p-2 float-end" href="javascript:void(0)"
                                        @click.prevent="deleteBrand()">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </template>
        <template #modals>
            <div class="modal fade" id="newBrandModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newBrandModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_brandLabel">
                                New brand
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
                                    <form role="form text-left" @submit.prevent="createBrand"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label col-form-label">
                                                NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    v-model="data.brands.name" id="name" placeholder="Name" required />
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label col-form-label">
                                                CODE
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="code"
                                                    v-model="data.brands.slug" id="slug" placeholder="Code" required />
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
            <div class="modal fade" id="editBrandModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newBrandModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_brandLabel">
                                New brand
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
                                    <form @submit.prevent="storeBrand()" role="form text-left"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label col-form-label">
                                                CODE
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="code"
                                                    id="code" placeholder="Code" required />
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label col-form-label">
                                                NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" placeholder="Name" required />
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
import { reactive } from 'vue';
import AppLayout from '../../../Layouts/AppLayout.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHouse, faPen, faTrash, faFloppyDisk, faXmark, faPlusCircle } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { onBeforeMount } from 'vue';
import axios from 'axios';

library.add(faHouse, faPen, faTrash, faFloppyDisk, faXmark, faPlusCircle);

const data = reactive({
    brands: {},
    brand: []
});

const createBrand = async () => {
    await axios.post(route("item-brand.store"), data.brands);
    $("#newBrandModal").modal("hide");
    data.brands = {};
    $("#newBrandModal").modal("hide");

}

// function editBrand(){
//     $("#editBrandModal").modal("show");
// }

onBeforeMount(()=>{
    getBrandData();
})

const getBrandData = async () => {
    try {
        const res = await axios.get(route("item-brand.all"));
        data.brand = res.data.data;
    } catch (error) {
        console.error('Error fetching brand data:', error);
    }
}

</script>

<style lang="scss" scoped></style>