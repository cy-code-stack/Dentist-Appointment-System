@extends('layouts.main-print')
@section('content')
<div class="mb-3">
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Personal Details</p>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="padding: 3; margin:0;">Name</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Email</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Address</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Birthday</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Age</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Religion</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="mb-3">
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Other Details</p>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="padding: 3; margin:0;">Place of Birth</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Nationality</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Contact Number</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Parents or Guardian</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Chief Complaint</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Referred by</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="mb-3">
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Dental History</p>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="padding: 3; margin:0;">Previous Dentist</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
                <td style="padding: 3; margin:0;">Last Dental Visit</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;"></input>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="mb-3">
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Medical History</p>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td width="20%" style="padding: 3; margin:0;">Name of the Physician</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding: 3; margin:0;">Office Address</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding: 3; margin:0;">Specialty (if applicable)</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;"></input>
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding: 3; margin:0;">Office Number</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;"></input>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="page-break"></div>
<!-- 2nd page -->

<div class="mb-3">
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Medical History</p>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>1. Are you in good health?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>2. Are you under medical treatment now?<br>If so, what is the condition being treated?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>3. Have you ever had serious illness or surgical operation? <br>If so, what illness or operation?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>4. Have you ever been hospitalized?<br>If so, when and why?</td>
                <td>If so, when and why?</td>
            </tr>
            <tr>
                <td>5. Are you taking any prescribtion / non-prescribtion medication?<br>If so, pls. specify?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>6. Do you use tabacco products?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>7. Do you use alcohol, cocaine, or other dangerous drugs?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>8. Do you have allergies?<br>Include what type of allergies</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>9. Are you pregnant?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>10. Are you nursing mother?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>11. Are you taking birth control pills?</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>12. Blood Type:</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>13. Blood Pressure:</td>
                <td>yes</td>
            </tr>
            <tr>
                <td>14. Do you have any health problem?<br>If so, what medications are you taking?</td>
                <td>yes</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="page-break"></div>
<!-- Page 3 -->
<div>
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Diagnostic</p>
</div>
@endsection