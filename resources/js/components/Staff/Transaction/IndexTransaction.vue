<template>
    <div class="container-fluid py-4">
        <div class="txt-title mb-3">
            <h5 class="fw-bold text-dark">Transaction History</h5>
        </div>

        <!-- Search Input -->
        <div class="d-flex justify-content-end mb-3">
            <input
                class="form-control form-control-sm"
                v-model="searchQuery"
                type="search"
                placeholder="Search..."
                style="max-width: 300px;"
            />
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered bg-white">
                <thead class="table-info text-center">
                    <tr>
                        <th>Name</th>
                        <th>Occupation</th>
                        <th>Services</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in transaction" :key="item.id" class="text-center">
                        <td>
                            {{ item.patient?.lastname }}, {{ item.patient?.firstname }} {{ item.patient?.middle_initial }}.
                        </td>
                        <td>{{ item.patient?.occupation || 'N/A' }}</td>
                        <td>{{ item.appoint_services?.services_name || 'N/A' }}</td>
                        <td>
                            <span
                                class="badge"
                                :class="{
                                    'bg-success': item.appnt_status === 'Completed',
                                    'bg-warning text-dark': item.appnt_status === 'Pending',
                                    'bg-danger': item.appnt_status === 'Cancelled',
                                    'bg-secondary': !['Completed', 'Pending', 'Cancelled'].includes(item.appnt_status)
                                }"
                            >
                                {{ item.appnt_status }}
                            </span>
                        </td>
                        <td>
                            <button
                                class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center"
                                :disabled="loadingInvoiceId === item.id"
                                @click="printInvoice(item.id)"
                            >
                                <span v-if="loadingInvoiceId === item.id" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                <i v-else class="fa-solid fa-print me-1"></i>
                                {{ loadingInvoiceId === item.id ? 'Loading...' : 'Invoice' }}
                            </button>
                        </td>
                    </tr>
                    <tr v-if="transaction.length === 0">
                        <td colspan="5" class="text-center text-muted">No records found.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                        <button class="page-link" @click.prevent="changePage(currentPage - 1)">
                            &laquo;
                        </button>
                    </li>
                    <li
                        class="page-item"
                        v-for="page in totalPages"
                        :key="page"
                        :class="{ active: currentPage === page }"
                    >
                        <button class="page-link" @click.prevent="changePage(page)">
                            {{ page }}
                        </button>
                    </li>
                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                        <button class="page-link" @click.prevent="changePage(currentPage + 1)">
                            &raquo;
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>



<script>
import axios from "axios";

export default {
    data() {
        return {
            transaction: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
            searchQuery: '',
            loadingInvoiceId: null,
        };
    },
    watch: {
        searchQuery(newQuery) {
            this.displayTransaction(1, newQuery);
        }
    },
    methods: {
        displayTransaction(page = 1, query = '') {
            axios
                .get("/user/staff/transaction/display", {
                    params: {
                        page,
                        limit: this.perPage,
                        search: query,
                    },
                })
                .then((response) => {
                    const { data, meta } = response.data;
                    if (data && meta) {
                        this.transaction = data;
                        this.currentPage = meta.current_page || 1;
                        this.totalPages = meta.last_page || 1;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching transactions:", error);
                });
        },
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.displayTransaction(page);
            }
        },
        printInvoice(id) {
            this.loadingInvoiceId = id;
            axios
                .get(`/patient/invoice/print/${id}`)
                .then((response) => {
                    const url = response.data.path;
                    window.open(url, "_blank");
                })
                .catch((error) => {
                    console.error("Error printing invoice:", error);
                })
                .finally(() => {
                    this.loadingInvoiceId = null;
                });
        },

    },
    mounted() {
        this.displayTransaction();
    },
};
</script>

<style scoped>
.badge {
    font-size: 0.85rem;
    padding: 0.5em 0.75em;
    border-radius: 0.5rem;
}
</style>

