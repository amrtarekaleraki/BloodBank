@component('mail::message')
# Introduction

Blood Bank reset password

@component('mail::button', ['url' => 'http::/ipda3.com'])
Reset
@endcomponent

<p>your reset code is {{$pincode}} </p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
