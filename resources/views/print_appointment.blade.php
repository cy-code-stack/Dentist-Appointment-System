@extends('layouts.main-print')
@section('content')
<div class="mb-3">
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Personal Details</p>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="padding: 3; margin:0;">Name</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $user?->firstname }} {{ $user?->middle_initial }}. {{ $user?->lastname }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Email</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $user?->email }}"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Address</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $user?->home_address }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Birthday</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ \Carbon\Carbon::parse($user?->birthdate)->format('F j, Y') }}"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Age</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $user?->age }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Religion</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->religion }}"></input>
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
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->place_of_birth }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Nationality</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->nationality }}"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Contact Number</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $user?->phone_number }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Parents or Guardian</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->guardian }}"></input>
                </td>
            </tr>
            <tr>
                <td style="padding: 3; margin:0;">Chief Complaint</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->chief_complaint }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Referred by</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->referred_by }}"></input>
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
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->previous_dentist }}"></input>
                </td>
                <td style="padding: 3; margin:0;">Last Dental Visit</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 250px; padding: 3px;" value="{{ $information?->last_dental_visit }}"></input>
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
                <td width="40%" style="padding: 3; margin:0;">Name of the Physician</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;" value="{{ $information?->physician_name }}"></input>
                </td>
            </tr>
            <tr>
                <td width="40%" style="padding: 3; margin:0;">Office Address</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;" value="{{ $information?->office_address }}"></input>
                </td>
            </tr>
            <tr>
                <td width="40%" style="padding: 3; margin:0;">Specialty (if applicable)</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;" value="{{ $information?->specialty }}"></input>
                </td>
            </tr>
            <tr>
                <td width="40%" style="padding: 3; margin:0;">Office Number</td>
                <td style="padding: 3; margin:0;">
                    <input style="height: 25px; width: 70%; padding: 3px;" value="{{ $information?->office_number }}"></input>
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
                <td>{{ $information?->good_health }}</td>
            </tr>
            <tr>
                <td>2. Are you under medical treatment now?<br>If so, what is the condition being treated?</td>
                <td>{{ $information?->medical_treatment ?? 'No' }}</td>
            </tr>
            <tr>
                <td>3. Have you ever had serious illness or surgical operation? <br>If so, what illness or operation?</td>
                <td>{{ $information?->surgical_operation ?? 'No' }}</td>
            </tr>
            <tr>
                <td>4. Have you ever been hospitalized?<br>If so, when and why?</td>
                <td>{{ $information?->hospitalized ?? 'No' }}</td>
            </tr>
            <tr>
                <td>5. Are you taking any prescribtion / non-prescribtion medication?<br>If so, pls. specify?</td>
                <td>{{ $information?->prescribtion_non_rescribtion_medication ?? 'No' }}</td>
            </tr>
            <tr>
                <td>6. Do you use tabacco products?</td>
                <td>{{ $information?->tabacco_products }}</td>
            </tr>
            <tr>
                <td>7. Do you use alcohol, cocaine, or other dangerous drugs?</td>
                <td>{{ $information?->dangerous_drugs }}</td>
            </tr>
            <tr>
                <td>8. Do you have allergies?<br>Include what type of allergies</td>
                <td>{{ $information?->allergy ?? 'No' }}</td>
            </tr>
            <tr>
                <td>9. Are you pregnant?</td>
                <td>{{ $information?->pregnant }}</td>
            </tr>
            <tr>
                <td>10. Are you nursing mother?</td>
                <td>{{ $information?->nursing_mother }}</td>
            </tr>
            <tr>
                <td>11. Are you taking birth control pills?</td>
                <td>{{ $information?->birth_control_pills }}</td>
            </tr>
            <tr>
                <td>12. Blood Type:</td>
                <td>{{ $information?->blood_type }}</td>
            </tr>
            <tr>
                <td>13. Blood Pressure:</td>
                <td>{{ $information?->blood_pressure }}</td>
            </tr>
            <tr>
                <td>14. Do you have any health problem?<br>If so, what medications are you taking?</td>
                <td>{{ $information->health_problem ?? 'No' }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="page-break"></div>
<!-- Page 3 -->
<div>
    <p class="text-primary fw-bold mb-3" style="font-size: 20px; font-weight: bold;">Diagnostic</p>
</div>
<table class="table table-borderless">
    <tbody>
        @foreach ($diagnostics->chunk(8) as $chunk) 
            <tr>
                @foreach ($chunk as $diagnostic)
                    <td style="padding: 1px; text-align: center;">
                        <div>{{ $diagnostic->teeth->teeth_number ?? '-' }}</div>
                        @if ($diagnostic->disease_id !== null)
                            <img src="{{ asset('storage/adult_disease/' . $diagnostic->teethDisease->disease_img_url) }}" alt="" width="40">
                        @else
                            <img src="{{ asset('storage/adult/' . $diagnostic->teeth->teeth_url) }}" alt="" width="40">
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th style="padding: 3px;" width="30%">Teeth Number</th>
            <th style="padding: 3px;" width="70%">Comments</th>
            <th style="padding: 3px;" width="30%">Teeth Number</th>
            <th style="padding: 3px;" width="70%">Comments</th>
        </tr>

        @php
            $upperTeeth = $diagnostics->filter(fn($d) => $d->teeth->teeth_number >= 11 && $d->teeth->teeth_number <= 28);
            $lowerTeeth = $diagnostics->filter(fn($d) => $d->teeth->teeth_number >= 31 && $d->teeth->teeth_number <= 48);

            $upperTeeth = array_values($upperTeeth->toArray());
            $lowerTeeth = array_values($lowerTeeth->toArray());

            $maxRows = max(count($upperTeeth), count($lowerTeeth));
        @endphp

        @for ($i = 0; $i < $maxRows; $i++)
            <tr>
                <td style="padding: 3px;">
                    {{ $upperTeeth[$i]['teeth']['teeth_number'] ?? 'N/A' }}
                </td>
                <td style="padding: 3px;">
                    {{ $upperTeeth[$i]['comments'] ?? '' }}
                </td>

                <td style="padding: 3px;">
                    {{ $lowerTeeth[$i]['teeth']['teeth_number'] ?? 'N/A' }}
                </td>
                <td style="padding: 3px;">
                    {{ $lowerTeeth[$i]['comments'] ?? '' }}
                </td>
            </tr>
        @endfor
    </tbody>
</table>
@endsection