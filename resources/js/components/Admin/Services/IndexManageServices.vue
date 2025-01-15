<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold mb-0">Manage Services</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <button class="btn btn-info btn-sm text-white" @click="addServices">
                        <i class="fa-solid fa-plus me-2"></i>
                        <span>Add Services</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive-lg">
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-4">
                    <p class="fs-6 fw-semibold mb-0">Service Name</p>
                </div>
                <div class="text-center col-lg-4">
                    <p class="fs-6 fw-semibold mb-0">Price</p>
                </div>
                <div class="text-center col-lg-4">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2" v-for="items in listofServices" :key="items.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-4">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ items?.services_name }}
                            </p>
                        </div>
                        <div class="text-center col-lg-4">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ formatCurrency(items?.price) }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-4">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center" @click="editServices(items)">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm" @click="deleteServices(items.id)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-box-archive me-2"></i>
                                    <span>Archive</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-end align-items-center" v-if="totalPages > 1">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" 
                            v-for="page in totalPages" 
                            :key="page" 
                            :class="{ active: currentPage === page }">
                            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <add-services-modal-vue @displayService="displayAllServices"></add-services-modal-vue>
            <edit-services-modal-vue :services_selection="services_selection" @updatedServices="displayAllServices"></edit-services-modal-vue>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import AddServicesModalVue from './AddServicesModal.vue';
import EditServicesModalVue from './EditServicesModal.vue';

export default {
    components: {
        AddServicesModalVue,
        EditServicesModalVue,
    },
    data() {
        return {
            services_selection: {},
            listofServices: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 5,
        };
    },
    methods: {
        formatCurrency(value) {
            if (!value) return "₱0.00";
            return new Intl.NumberFormat("en-PH", {
                style: "currency",
                currency: "PHP",
            }).format(value);
        },
        displayAllServices(page = 1) {
            axios.get("/admin/display/data", {
                params: {
                    page: page,
                    limit: this.perPage,
                },
            }).then((response) => {
                this.listofServices = response.data.data;
                this.currentPage = response.data.meta.current_page;
                this.totalPages = response.data.meta.last_page;
            }).catch((error) => {
                console.log(error);
            });
        },
        changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.displayAllServices(page);
            }
        },
        addServices() {
            $("#add-services-modal").modal("show");
        },

        editServices(services_selection) {
            this.services_selection = services_selection;
            $("#edit-services-modal").modal("show");
        },

        deleteServices(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, archive it!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios
                            .put("/admin/services/archive/" + id)
                            .then((response) => {
                                Swal.fire("Archive!", "Services has been archived.", "success");
                                this.displayAllServices(this.currentPage); 
                            });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: "error",
                        text: "Something went wrong!",
                    });
                    console.log(error);
                });
        },
    },
    mounted() {
        this.displayAllServices();
    },
};
</script>

