<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold mb-0">Manage Users</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-1">
            <div class="select-input d-flex justify-content-end align-items-center" style="width: 50% !important;">
                <form class=" me-2" role="search" style="width: 40% !important;">
                    <input class="form-control form-control-sm" v-model="searchQuery" type="search" placeholder="Search" aria-label="Search">
                </form>
                <button class="btn btn-info btn-sm text-white" @click="addUser">
                    <i class="fa-solid fa-plus me-2"></i>
                    <span>Add User</span>
                </button>
            </div>
        </div>
        <div class="table-responsive-lg">
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Firstname</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Lastname</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Email</p>
                </div>
                <div class="text-center col-lg-1">
                    <p class="fs-6 fw-semibold mb-0">Role</p>
                </div>
                <div class="text-center col-lg-4">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2" v-for="user in listofUsers" :key="user.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ user.firstname }}</p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ user.lastname }}</p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50 text-center">{{ user.email }}</p>
                        </div>
                        <div class="text-center col-lg-1">
                            <p :class="{'fs-6 fw-semibold mb-0 text-primary': user.assistant, 'fs-6 fw-semibold mb-0 text-success': user.patient}">
                                {{ user.role }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-4 gap-1">
                            <button type="button" class="rounded-1 btn btn-info btn-sm text-white" v-if="user.verified" @click="editUser(user)"> 
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-success btn-sm text-white" v-if="!user.verified" @click="verifyUser(user)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>View</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-danger btn-sm" @click="deleteUser(user.id)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-ban me-2"></i>
                                    <span>Banned</span>
                                </div>
                            </button>
                            <router-link :to="`/user/staff/history/${user.id}`">
                                <button type="button" class="rounded-1 btn btn-success btn-sm text-white">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-regular fa-file me-2"></i>
                                        <span>History</span>
                                    </div>
                                </button>
                            </router-link>
                            <router-link :to="`/user/staff/payment/history/${user.id}`">
                                <button type="button" class="rounded-1 btn btn-primary btn-sm text-white">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-peso-sign me-2"></i>
                                        <span>Payment History</span>
                                    </div>
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
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
        <view-user-modal :selected_user="selected_user" @displayVerifiedUsers="displayUsers"></view-user-modal>
        <add-modal-vue @displayUsers="displayUsers"></add-modal-vue>
        <edit-user-vue :edited_select_user="edited_select_user" @updatedUsers=" displayUsers"></edit-user-vue>
    </div>
</template>


<script>
import AddModalVue from './AddModal.vue';
import EditUserVue from './EditUser.vue';
import ViewUserModal from './IndexViewUserModal.vue';
export default {
    components: {
        ViewUserModal,
        AddModalVue,
        EditUserVue,
    },
    data() {
        return {
            selected_user: {},
            edited_select_user: {},
            listofUsers: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
            searchQuery: '',
        };
    },
    methods: {
        displayUsers(page = 1, query = '') {
            axios.get("/user/staff/manage/user", {
                params: {
                    page: page,        
                    limit: this.perPage, 
                    search: query,
                },
            }).then((response) => {
                this.currentPage = response.data.meta.current_page;
                this.totalPages = response.data.meta.last_page;
                this.listofUsers = response.data.data.map((user) => ({
                    ...user,
                    verified: user.status === "verified",
                    patient: user.role === "Patient",
                    assistant: user.role === "Assistant",
                }));
            }).catch((error) => {
                console.log(error);
            });
        },
        changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.displayUsers(page);
            }
        },
        addUser(){
            $("#add-user-modal").modal("show");
        },
        verifyUser(selected_user) {
            this.selected_user = selected_user;
            $("#verify-user-modal").modal("show");
        },
        editUser(edited_select_user){
            this.edited_select_user = edited_select_user;
            $("#edit-user-modal").modal("show");
        },
        deleteUser(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Banned it!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios
                            .put("/user/staff/user/archieve/" + id)
                            .then((response) => {
                                Swal.fire("Banned!", "Patient has been banned.", "success");
                                this.displayUsers();
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
        this.displayUsers();
    },
};
</script>
