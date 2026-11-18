@php
    $student = $student ?? new \App\Models\Student();
@endphp

<x-form-input name="name" label="Name" :value="$student->name" required autocomplete="name" />
<x-form-input name="email" label="Email" type="email" :value="$student->email" required autocomplete="email" />
<x-form-input name="phone" label="Phone" :value="$student->phone" required autocomplete="tel" />
<x-form-textarea name="address" label="Address" :value="$student->address" rows="4" />
<x-form-input
    name="date_of_birth"
    label="Date of birth"
    type="date"
    :value="$student->date_of_birth?->format('Y-m-d')"
/>
