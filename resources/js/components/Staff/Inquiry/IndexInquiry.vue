<template>
    <div class="container-fluid p-4">
        <p class="fs-4 fw-semibold text-primary mb-3">Patient Inquiries</p>

        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <p class="fs-5 text-secondary mb-0">List of Patient Inquiries</p>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Facebook Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="items in listofInquiry" :key="items.id">
                                <td class="fs-6 text-break">{{ items.lname }}</td>
                                <td class="fs-6 text-break">{{ items.fname }}</td>
                                <td class="fs-6 text-break text-truncate">
                                    <a :href="items.fblink" class="text-decoration-none text-primary" target="_blank">
                                        <i class="fa-brands fa-facebook me-1"></i> <span class="fs-6">Facebook</span>
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-info btn-sm d-flex align-items-center gap-2" 
                                            @click="ViewInquiryModal(items)">
                                            <i class="fa-solid fa-eye"></i> Reply
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm d-flex align-items-center gap-2" 
                                            @click="alreadyCatered(items.id)">
                                            <i class="fa-solid fa-check"></i> Catered
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="d-flex justify-content-end mt-3">
                    <ul class="pagination gap-2">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">&laquo;</a>
                        </li>
                        <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <view-inquiry-modal :selected_inq="selected_inq" @updatedInquiry="displayInquiry"></view-inquiry-modal>
    </div>
</template>




<script>
import axios from 'axios';
import ViewInquiryModal from './ViewInquiryModal.vue';

export default {
    components:{
        ViewInquiryModal
    },
    data(){
        return{
            listofInquiry:[],
            selected_inq:{},
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
        };
    },
    methods:{
       displayInquiry(page = 1,){
            axios.get('/user/staff/inquiry/display',{
                params: {
                    page: page,        
                    limit: this.perPage
                },
            }).then((response)=>{
                this.listofInquiry = response.data.data;
                this.currentPage = response.data.meta.current_page;
                this.totalPages = response.data.meta.last_page;
            }).catch((error) =>{
                console.log(error);
            });
       },
       changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.displayInquiry(page);
            }
        },
       ViewInquiryModal(selected_inq){
            this.selected_inq = selected_inq;
            $("#view-inquiry-modal").modal("show");
       },

       alreadyCatered(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, already catered!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios
                            .put("/user/staff/inquiry/alreadyCatered/" + id)
                            .then((response) => {
                                Swal.fire("Catered!", "Inquiry has been catered.", "success");
                                this.displayInquiry();
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
        this.displayInquiry();
    }
}
</script>