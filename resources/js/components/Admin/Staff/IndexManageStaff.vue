<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold  mb-0">Manage Staff</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <button class="btn btn-info btn-sm text-white">
                        <i class="fa-solid fa-plus me-2"></i>
                        <span>Add Staff</span>
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
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Firstname</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Lastname</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Middle name</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Email</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Status</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-2">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                D
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                staffemail@gmail.com
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-success">
                               Online
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-2">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    <span>Edit</span>
                                </div>
                            </button>
                            <button type="button" class=" rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
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
