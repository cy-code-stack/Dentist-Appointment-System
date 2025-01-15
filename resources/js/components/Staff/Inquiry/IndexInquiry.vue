<template>
    <div class="container-fluid">
        <p class="fs-5 fw-semibold mb-0 p-2">Patient Inquiries</p>

        <div class="container mt-3">
            <table class="table text-center mb-1">
                <thead>
                    <tr>
                        <th scope="col">Lastname</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Facebook Link</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr v-for="items in listofInquiry" :key="items.id">
                        <td><span class="fs-6 text-break">{{ items.lname }}</span></td>
                        <td><span class="fs-6 text-break">{{ items.fname }}</span></td>
                        <td><span class="fs-6 text-break"><a class="text-decoration-none text-black" :href="items.fblink"><small>{{ items.fblink }}</small></a></span></td>
                        <td>
                            <div class="text-center d-flex justify-content-center">
                                <button type="button" class="me-1 rounded-1 btn btn-success btn-sm text-white" @click="ViewInquiryModal(items)">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        <span>View</span>
                                    </div>
                                </button>
                                <button type="button" class="me-1 rounded-1 btn btn-primary btn-sm text-white" @click="alreadyCatered(items.id)">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-check me-2"></i>
                                        <span>Catered in Facebook</span>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="container-fluid d-flex justify-content-end align-items-center">
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
        </div>
        <view-inquiry-modal :selected_inq = selected_inq @updatedInquiry="displayInquiry"></view-inquiry-modal>
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