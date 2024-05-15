<template>
    <div class="container" id="basic-info">
        <div class="card-header">
            <h5>Images</h5>
        </div>
        <div class="card-body pt-0 mt-3">
            <div class="col-lg-12 text-right">
                <a
                    href="javascript:void(0)"
                    data-toggle="modal"
                    data-target="#newImage"
                    @click.prevent="newImage"
                    class="btn btn-sm btn-neutral float-end"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                    ADD NEW
                </a>
            </div>
        </div>
        <div class="row">
            <div
                class="col-md-4"
                v-for="product in productDetails"
                :key="product.id"
            >
                <div class="thumbnail">
                    {{ product.images.name }}
                    <div v-if="product.status != 0 && product.status != 2">
                        <div>
                            <Link @click.prevent="deleteImage(product.id)">
                                <a
                                    class="badge bg-danger text-white fw-bold ml-4"
                                    >Delete
                                </a>
                            </Link>
                            <Link
                                @click.prevent="primaryImageStatus(product.id)"
                            >
                                <a
                                    class="badge bg-success text-white fw-bold ml-5"
                                    >Primary
                                </a>
                            </Link>
                            <Link
                                @click.prevent="deactiveImageStatus(product.id)"
                            >
                                <a
                                    class="badge bg-warning text-white fw-bold ml-5"
                                    >Deactive
                                </a>
                            </Link>
                        </div>
                    </div>
                    <div v-if="product.status == 2">
                        <div>
                            <Link
                                @click.prevent="activeImageStatus(product.id)"
                            >
                                <a
                                    class="badge bg-success text-white fw-bold ml-8"
                                    >Active
                                </a>
                            </Link>
                        </div>
                    </div>
                    <img
                        :src="product.images.name"
                        alt="Product"
                        class="product-img mt-1"
                        height="200"
                        width="300"
                        href=""
                    />
                    <div class="caption"></div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="newImage"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="newImage"
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
                            Upload Images
                        </h5>
                        <button
                            type="button"
                            class="close btn"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click.prevent="clearImageField"
                        >
                            <span aria-hidden="true">
                                <font-awesome-icon icon="fa-solid fa-xmark" />
                            </span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card-plain">
                            <div class="card-body m-2">
                                <form
                                    role="form text-left"
                                    @submit.prevent="addImage"
                                    enctype="multipart/form-data"
                                >
                                    <div class="row mb-1">
                                        <div
                                            for="name"
                                            class="col-md-3 col-form-label col-form-label"
                                        ></div>
                                        <div class="col-md-9">
                                            <input
                                                type="file"
                                                multiple
                                                @change="onFileChange"
                                                id="image-upload"
                                            />
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
                                            ADD
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faCirclePlus,
    faFloppyDisk,
    faXmark,
} from "@fortawesome/free-solid-svg-icons";
import { onBeforeMount, reactive, ref } from "vue";

library.add(faCirclePlus, faFloppyDisk, faXmark);

onBeforeMount(() => {
    getProductdata();
});

const props = defineProps({
    productId: {
        type: Number,
        required: true,
    },
});

// const reload = async () => {
//     getProductdata();
// };

const productDetails = ref([]);
const product = ref([]);

const state = reactive({
    images: [],
});

const clearImageField = async () => {
    document.getElementById("image-upload").value = [];
    state.images = [];
};

const getProductdata = async () => {
    try {
        const response = (
            await axios.get(route("product.image.getProducts", props.productId))
        ).data;
        productDetails.value = response.data;
    } catch (error) {
        console.error("Error fetching Brands data:", error);
    }
};

const onFileChange = (event) => {
    let selectedFiles = event.target.files;

    for (let i = 0; i < selectedFiles.length; i++) {
        state.images.push(selectedFiles[i]);
    }
};

const addImage = async () => {
    const formData = new FormData();

    for (let i = 0; i < state.images.length; i++) {
        formData.append("images[]", state.images[i]);
    }

    const config = {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    };

    try {
        document.getElementById("image-upload").value = [];
        await axios.post(
            route("product.image.store", props.productId),
            formData,
            config
        );

        $("#newImage").modal("hide");
        reload();
    } catch (error) {
        console.error("Upload failed:", error);
    }
};

const deleteImage = async (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You want Delete this image.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#C00202",
        cancelButtonColor: "#6CA925",
        confirmButtonText: "Yes Delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(route("product.productImage.deleteImage", id));
            axios.delete(route("product.image.deleteImage", id));
            window.location.reload();
            //reload();
            Swal.fire("Deleted!", `Image has been deleted.`, "success");
        }
    });
};

const primaryImageStatus = async (id) => {
    //console.log(id);
    Swal.fire({
        title: "Are you sure?",
        text: "You want change Primary Image to this.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#C00202",
        cancelButtonColor: "#6CA925",
        confirmButtonText: "Yes, Change it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.get(route("product.productImage.updateStatus", id));
            window.location.reload();
            //reload();
            Swal.fire("Update!", `Primary Image has been updated.`, "success");
        }
    });
};
const deactiveImageStatus = async (id) => {
    //console.log(id);
    Swal.fire({
        title: "Are you sure?",
        text: "You want Deactivate.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#C00202",
        cancelButtonColor: "#6CA925",
        confirmButtonText: "Yes, Deactive it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.get(route("product.productImage.deactiveStatus", id));
            window.location.reload();
            //reload();
            Swal.fire("Update!", `Image has been deactivated.`, "success");
        }
    });
};
const activeImageStatus = async (id) => {
    //console.log(id);
    Swal.fire({
        title: "Are you sure?",
        text: "You want Activate.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#C00202",
        cancelButtonColor: "#6CA925",
        confirmButtonText: "Yes, Activate it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.get(route("product.productImage.activeStatus", id));
            window.location.reload();
            //reload();
            Swal.fire("Update!", `Image has been Activated.`, "success");
        }
    });
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
