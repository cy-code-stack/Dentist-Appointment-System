<template>
    <div class="modal fade" id="view-appointment-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Record Chart</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="company-serv card w-100 mb-2 d-flex align-items-between justify-content-between p-3">
                            <p class="fw-semibold mb-0 fs-3 text-success text-center">Patient's Examination Record Chart</p>
                            <p class="fw-medium mb-0 fs-5 text-black-50 text-center">Graces Dental Clinnic</p>
                            <p class="fw-medium mb-4 fs-6 text-black-50 text-center">Sample Address Panabo City || 09123456789 || sampleemail123@gmail.com</p>
                                <div class="form-group mb-1 d-flex justify-content-start w-100">
                                    <div class="me-1">
                                        <label class="form-label mb-0">Firstname</label>
                                        <input type="text" class="form-control" v-model="patientDiag.firstname"/>
                                    </div>
                                    <div class="me-1">
                                        <label class="form-label mb-0">Lastname</label>
                                        <input type="text" class="form-control" v-model="patientDiag.lastname"/>
                                    </div>
                                    <div class="me-1">
                                        <label class="form-label mb-0">Home Address</label>
                                        <input type="text" class="form-control" v-model="patientDiag.home_address"/>
                                    </div>
                                    <div>
                                        <label class="form-label mb-0">Contact</label>
                                        <input type="text" class="form-control" v-model="patientDiag.phone_number"/>
                                    </div>
                                </div>
                                <div class="form-group mb-2 d-flex justify-content-start align-items-center w-100">
                                    <div class="me-1">
                                        <label class="form-label mb-0">Age</label>
                                        <input type="text" class="form-control"  v-model="patientDiag.age"/>
                                    </div>
                                    <div class="me-1">
                                        <label class="form-label mb-0">Sex</label>
                                        <input type="text" class="form-control" v-model="patientDiag.sex"/>
                                    </div>
                                    <div class="me-1">
                                        <label class="form-label mb-0">Marital Status</label>
                                        <input type="text" class="form-control" v-model="patientDiag.marital_status"/>
                                    </div>
                                    <div class="me-1">
                                        <label class="form-label mb-0">Occupation</label>
                                        <input type="text" class="form-control" v-model="patientDiag.occupation"/>
                                    </div>
                                    <div>
                                        <label class="form-label mb-0">Date</label>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                                
                                <div class="main-body-chart d-flex mb-3 justify-content-between">
                                    <div class="info card col-lg-3 mb-0 p-2 rounded me-2">
                                        <p class="fs-6 fw-medium text-center text-black-50 mb-1">Enter "NONE" if the patient does not have any results of the said field.</p>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">OCCLUSION</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Periodontal Condition</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label  fw-medium mb-0">Oral Hygiene</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <p class="fs-6 fw-medium mb-0">Denture</p>
                                            <div class="denture-opt d-flex flex-column">
                                                <div class="ms-3">
                                                    <div>
                                                        <label class="form-label fw-medium mb-0">Upper</label>
                                                        <input type="text" class="form-control form-control-sm mb-1" placeholder="Upper"/>
                                                        <label class="form-label fw-medium mb-0">Since</label>
                                                        <input type="date" class="form-control form-control-sm mb-1"/>
                                                    </div>
                                                    <hr class="border border-black border-1 opacity-25 rounded"/>
                                                    <div>
                                                        <label class="form-label fw-medium mb-0">Lower</label>
                                                        <input type="text" class="form-control form-control-sm mb-1" placeholder="Lower"/>
                                                        <label class="form-label fw-medium mb-0">Since</label>
                                                        <input type="date" class="form-control form-control-sm mb-1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Abnormalities</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">General Condition</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Physician</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Nature of Treatment</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Allergies</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Previous History of Bleeding</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Chronic Ailments</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Blood Pressure</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fw-medium mb-0">Drugs Being Taken</label>
                                            <input type="text" class="form-control form-control-sm"/>
                                        </div>
                                    </div>
                                    <div class="info card col-lg-9 p-4 rounded min-vh-100 mb-0">
                                        <div class="d-flex flex-column mb-0 justify-content-start overflow-auto">
                                            <p class="fs-5 fw-semibold">Patient Diagnostics</p>

                                            <p class="fs-6 fw-medium mb-1">Upper Part</p>
                                            <table class="table table-sm text-center">
                                                <thead >
                                                    <tr >
                                                        <th class="fw-medium">Teeth Number</th>
                                                        <th class="fw-medium">Normal</th>
                                                        <th class="fw-medium">Naay Daot</th>
                                                        <th class="fw-medium">Need Ibton</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-group-divider">
                                                    <tr>
                                                        <td>18</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>17</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>16</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>15</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>14</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>13</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>21</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>22</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>23</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>24</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>25</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>26</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>27</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>28</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>


                                            <p class="fs-6 fw-medium mb-1">Lower Part</p>
                                            <table class="table table-sm text-center">
                                                <thead >
                                                    <tr >
                                                        <th class="fw-medium">Teeth Number</th>
                                                        <th class="fw-medium">Normal</th>
                                                        <th class="fw-medium">Naay Daot</th>
                                                        <th class="fw-medium">Need Ibton</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-group-divider">
                                                    <tr>
                                                        <td>48</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>47</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>46</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>45</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>44</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>43</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>42</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>41</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>31</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>32</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>33</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>34</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>35</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>36</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>37</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>38</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="2">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="3">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="active-btn">
                                    <button type="submit" class="btn btn-success text-white mt-2 btn-md-1 w-100" @click="paymentModal()">Done</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <payment-modal></payment-modal>
    </div>
</template>

<style>
@import "/resources/css/Patient/indexpatient.css";
</style>

<script>
import PaymentModal from './IndexPayment.vue';
export default {
    props: ["selected_patient"],
components:{
    PaymentModal,
},
data() {
    return {
        patientDiag: {
            id:'',
            firstname:'',
            lastname:'',
            home_address:'',
            phone_number:'',
            email:'',
            marital_status:'',
            occupation:'',
            age:'',
            sex:'',
        }
    };
},
methods: {
    paymentModal(){
        // $('#view-appointment-modal').modal('hide');
        $('#diagnose-payment-modal').modal('show');
    },
},
watch:{
    selected_patient: {
        handler(val) {
            // console.log(val);
            this.patientDiag.id = val.id;
            this.patientDiag.firstname = val.patient?.firstname;
            this.patientDiag.lastname = val.patient?.lastname;
            this.patientDiag.home_address = val.patient?.home_address;
            this.patientDiag.email = val.patient?.email;
            this.patientDiag.phone_number = val.patient?.phone_number;
            this.patientDiag.age = val.patient?.age;
            this.patientDiag.sex = val.patient?.sex;
            this.patientDiag.marital_status = val.patient?.marital_status;
            this.patientDiag.occupation = val.patient?.occupation;
        },
        deep: true,
    },
},
mounted() {
    console.log("Component loaded");
},
};
</script>
