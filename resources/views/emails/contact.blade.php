@component('mail::message')
# New Contact Message

You have received a new contact message from ThriftMotors.

**Name:** {{ $data['name'] }}
**Email:** {{ $data['email'] }}
**Phone:** {{ $data['phone'] }}

**Message:**
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
