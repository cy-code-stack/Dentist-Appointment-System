<template>
    <div class="modal fade" id="edit-services-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Edit Service</p>
                                <button
                                    type="button"
                                    class="btn-close btn-black"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Service name</label>
                                    <input type="text" class="form-control" placeholder="Enter new services name" v-model="services.services_name"/>
                                </div>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" v-model="services.price"/>
                                </div>
                            </div>
                            <div class="active-btn">
                                <button type="button" class="btn btn-success text-white btn-md-1 w-100" @click=" updateServices(services.id)">Edit Services</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:["services_selection"],
    data() {
        return {
            services: {
                id: '',
                services_name: '',
                price: '',
            },
        }
    },
    methods:{
        updateServices(id){
            axios.put('/admin/services/edit/' + id, this.services).then((response)=>{
                console.log(response);
                $("#edit-services-modal").modal("hide");
                Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Services has been updated!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    this.$emit("updatedServices");
            }).catch((error)=>{
                console.log(error);
            });
        },
    },
    watch:{
        services_selection: {
            handler(val) {
                this.services.id = val.id;
                this.services.services_name = val.services_name;
                this.services.price = val.price;
            },
            deep: true,
        },
    },
}
</script>