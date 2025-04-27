<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold mb-0">Manage Patient</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-1">
            <div class="select-input d-flex justify-content-end align-items-center" style="width: 50% !important;">
                <form class="me-2" role="search" style="width: 40% !important;">
                    <input class="form-control form-control-sm" v-model="searchQuery" type="search" placeholder="Search" aria-label="Search">
                </form>
                <button class="btn btn-info btn-sm text-white" @click="addUser">
                    <i class="fa-solid fa-plus me-2"></i>
                    <span>Add Patient</span>
                </button>
            </div>
        </div>
        <div class="table-responsive-lg">
            <table class="table table-striped table-bordered">
                <thead class="bg-info text-white">
                    <tr>
                        <th class="text-center">Firstname</th>
                        <th class="text-center">Lastname</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in listofUsers" :key="user.id">
                        <td class="text-center">{{ user.firstname }}</td>
                        <td class="text-center">{{ user.lastname }}</td>
                        <td class="text-center">{{ user.email }}</td>
                        <td class="text-center" :class="{'text-primary': user.assistant, 'text-success': user.patient}">
                            {{ user.role }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <button v-if="user.verified" class="btn btn-info btn-sm text-white" @click="editUser(user)">
                                    <i class="fa-solid fa-user-pen me-2"></i> Edit
                                </button>
                                <button v-if="!user.verified" class="btn btn-info btn-sm text-white" @click="verifyUser(user)">
                                    <i class="fa-solid fa-eye me-2"></i> View
                                </button>
                                <button class="btn btn-danger btn-sm" @click="deleteUser(user.id)">
                                    <i class="fa-solid fa-ban me-2"></i> Banned
                                </button>
                                <router-link :to="`/user/admin/patient/history/${user.id}`" class="btn btn-warning btn-sm text-white">
                                    <i class="fa-regular fa-file me-2"></i> History
                                </router-link>
                                <router-link :to="`/user/admin/payment/history/${user.id}`" class="btn btn-primary btn-sm text-white">
                                    <i class="fa-solid fa-peso-sign me-2"></i> Payment History
                                </router-link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <nav>
                    <ul class="pagination">
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
        <view-user-modal :selected_user="selected_user" @displayVerifiedUsers="displayUsers"></view-user-modal>
        <add-modal-vue @displayUsers="displayUsers"></add-modal-vue>
        <edit-user-vue :edited_select_user="edited_select_user" @updatedUsers="displayUsers"></edit-user-vue>
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
    watch: {
        searchQuery(newQuery) {
            this.displayUsers(1, newQuery);
        }
    },
    methods: {
        displayUsers(page = 1, query = '') {
            axios.get("/user/admin/patient/display", {
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
                            .put("/user/admin/patient/archieve/" + id)
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
