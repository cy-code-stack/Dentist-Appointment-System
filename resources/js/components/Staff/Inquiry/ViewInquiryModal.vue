<template>
    <div class="modal fade" id="view-inquiry-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">View Details</p>
                            <button
                                type="button"
                                class="btn-close btn-black"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div
                            class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3"
                        >
                            <div
                                class="form-group mb-1 d-flex justify-content-between w-100"
                            >
                                <div class="me-1 w-100">
                                    <label class="form-label mb-0">Firstname</label>
                                    <p class="fs-6 fw-medium mb-0">{{ inquiry.fname }}</p>
                                </div>
                                <div class="w-100">
                                    <label class="form-label mb-0">Lastname</label>
                                    <p class="fs-6 fw-medium mb-0">{{ inquiry.lname }}</p>
                                </div>
                            </div>
                            <div
                                class="form-group mb-1 d-flex justify-content-between w-100"
                            >
                                <div class="me-1 w-100">
                                    <label class="form-label mb-0">Email</label>
                                    <p class="fs-6 fw-medium mb-0">{{ inquiry.email }}</p>
                                </div>
                                <div class="w-100">
                                    <label class="form-label mb-0">Contact Number</label>
                                    <p class="fs-6 fw-medium mb-0">{{ inquiry.cnumber }}</p>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label mb-1"
                                    >Message</label
                                >
                                <textarea class="form-control" v-model="inquiry.message" disabled style="resize: none; max-height: 150px;"></textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label mb-1"
                                    >Reply</label
                                >
                                <textarea class="form-control" placeholder="Reply here" v-model="inquiry.reply"></textarea>
                            </div>
                            <p class="fw-semibold mb-0 text-end mt-2" style="font-size: 12px;">Status: <small class="text-danger fw-semibold">{{ inquiry.status }}</small></p>
                        </div>
                        <div class="active-btn">
                            <button
                                type="submit"
                                class="btn btn-success text-white btn-md-1 w-100"
                                @click="sendInquiry(inquiry.id)"
                            >
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
@import "/resources/css/Patient/indexpatient.css";
</style>

<script>
import axios from "axios";

export default {
    props: ["selected_inq"],
    data() {
        return {
            inquiry: {
                id: "",
                fname: "",
                lname: "",
                email: "",
                fblink: "",
                cnumber: "",
                message: "",
                reply: "",
                status: ""
            },
        };
    },
    methods: {
        sendInquiry(id){
            axios.put('/user/staff/inquiry/send/' + id, this.inquiry).then((response)=>{
                console.log(response);
                this.resetForm();
                $('#view-inquiry-modal').modal('hide');
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Message has been sent!",
                    showConfirmButton: false,
                    timer: 2000,
                });
                this.$emit("updatedInquiry");
            }).catch((error)=>{
                console.log(error);
            });
        },
        resetForm() {
            this.inquiry = {
                id: "",
                reply:"",
            };
        },
    },
    watch: {
        selected_inq: {
            handler(val) {
                this.inquiry.id = val.id;
                this.inquiry.fname = val.fname;
                this.inquiry.lname = val.lname;
                this.inquiry.email = val.email;
                this.inquiry.fblink = val.fblink;
                this.inquiry.cnumber = val.cnumber;
                this.inquiry.message = val.message;
                this.inquiry.status = val.status;
            },
            deep: true,
        },
    },
    mounted() {
        
    },
};
</script>
