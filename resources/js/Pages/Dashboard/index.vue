<template>
    <AppLayout title="Computer Shop">
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 col align-items-center">
                            <h6 class="mb-0 h2 text-dark d-inline-block">Dashboard</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link href="/">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                        Dashboard
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
            <div class="mt-3 row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold">Total Materials
                                                </p>
                                                <h5 class="font-weight-bolder">
                                                    {{ total_products }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-danger shadow-danger rounded-circle">
                                                <i class="text-lg ni ni-world opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold">Total BOM Sheets
                                                </p>
                                                <h5 class="font-weight-bolder">
                                                    {{ total_brands }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-primary shadow-primary rounded-circle">
                                                <i class="text-lg ni ni-money-coins opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold">Total Vendors
                                                </p>
                                                <h5 class="font-weight-bolder">
                                                    {{ total_categories }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-success shadow-success rounded-circle">
                                                <i class="text-lg ni ni-paper-diploma opacity-10"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold">Total PO</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ total_sum }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-warning shadow-warning rounded-circle">
                                                <i class="text-lg ni ni-cart opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
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
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHouse } from '@fortawesome/free-solid-svg-icons'
import { defineProps } from 'vue';

library.add(faHouse);

const props = defineProps({
    total_products: { default: 10 },
    total_brands: { default: 10 },
    total_categories: { default: 10 },
    total_sum: { default: 30 },
})
</script>

<style lang="scss" scoped>
.breadcrumb-text{
    color: #6343e9 !important;
}
</style>
