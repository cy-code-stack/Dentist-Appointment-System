<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold  mb-0">Manage Services</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <!-- <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    </form> -->
                    <button class="btn btn-info btn-sm text-white" @click="addServices">
                        <i class="fa-solid fa-plus me-2"></i>
                        <span>Add Services</span>
                    </button>
                    <!-- <select class="form-control form-control-sm">
                        <option selected disabled>Filter</option>
                        <option value="">Pending</option>
                        <option value="">Completed</option>
                        <option value="">Decline</option>
                    </select> -->
                </div>
            </div>
        </div>
        <div class="table-responsive-lg">
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-7">
                    <p class="fs-6 fw-semibold mb-0">Service Name</p>
                </div>
                <div class="text-center col-lg-5">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2" v-for="items in listofServices" :key="items.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-7">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ items.services_name }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-5">
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
            <div class="container-fluid d-flex justify-content-end p-0 align-items-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
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
    components:{
        AddServicesModalVue,
        EditServicesModalVue,
    },
    data(){
        return{
            services_selection: {},
            listofServices: [],
        }
    },
    methods:{
        displayAllServices(){
            axios.get("/admin/display/data").then((response)=>{
                console.log(response);
                this.listofServices = response.data;
            }).catch((error)=>{
                console.log(error);
            });
        },


        addServices(){
            $("#add-services-modal").modal("show");
        },

        editServices(services_selection){
            this.services_selection = services_selection;
            $("#edit-services-modal").modal("show");
        },

        deleteServices(id){
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
                                Swal.fire("Archive!", "Services has been archive.", "success");
                                this.displayAllServices();
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
    mounted(){
        this.displayAllServices();
    }
};
</script>
