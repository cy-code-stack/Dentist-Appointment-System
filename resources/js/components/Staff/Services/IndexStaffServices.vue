<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-3 fw-semibold text-primary mb-0">Services</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div
                    class="select-input d-flex justify-content-center align-items-center"
                >
                    <form class="d-flex" role="search">
                        <input
                            class="form-control form-control-sm me-2"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                        />
                    </form>
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
            <div
                class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2"
            >
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Sevices Name</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Price</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Status</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2">
                    <div
                        class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1"
                    >
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                700 php
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Available
                            </p>
                        </div>
                        <div
                            class="text-center d-flex justify-content-center col-lg-3"
                        >
                            <button
                                type="button"
                                class="me-1 rounded-1 btn btn-info btn-sm text-white"
                            >
                                <div
                                    class="d-flex justify-content-center align-items-center"
                                >
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button
                                type="button"
                                class="rounded-1 btn btn-danger btn-sm"
                            >
                                <div
                                    class="d-flex justify-content-center align-items-center"
                                >
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div
                        class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1"
                    >
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                700 php
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Available
                            </p>
                        </div>
                        <div
                            class="text-center d-flex justify-content-center col-lg-3"
                        >
                        <button
                                type="button"
                                class="me-1 rounded-1 btn btn-info btn-sm text-white"
                            >
                                <div
                                    class="d-flex justify-content-center align-items-center"
                                >
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button
                                type="button"
                                class="rounded-1 btn btn-danger btn-sm"
                            >
                                <div
                                    class="d-flex justify-content-center align-items-center"
                                >
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="container-fluid d-flex justify-content-end align-items-center"
                >
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a
                                    class="page-link"
                                    href="#"
                                    aria-label="Previous"
                                >
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
