<template>
    <div class="modal fade" id="add-services-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <form @submit.prevent="storeServices">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Add Service</p>
                                <button
                                    type="button"
                                    class="btn-close btn-black"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                                <p class="fw-medium mb-2">Fill the form for adding a service.</p>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Service name</label>
                                    <input type="text" class="form-control" placeholder="Enter new services name" v-model="services.services_name"/>
                                </div>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" placeholder="Price" v-model="services.price"/>
                                </div>
                            </div>
                            <div class="active-btn">
                                <button type="submit" class="btn btn-success text-white btn-md-1 w-100" > Add Services</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            services: {
                id: '',
                services_name: '',
                price: '',
            },
            errors: {},
        };
    },
    methods: {
        storeServices(){
            axios.post("/admin/services/add", this.services).then((response)=> {
                console.log(response);
                
                this.clearForm();
                $("#add-services-modal").modal("hide");
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Services has been added!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.$emit('displayService');
            }).catch((error)=>{
                console.log(error);
            });
        },

        clearForm(){
            this.services = {
                id: '',
                services_name: '',
                price: '',
            };
        },
    },
};
</script>
