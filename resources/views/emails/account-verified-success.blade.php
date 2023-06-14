<x-mail::message>
# Your Account Has Been Verified Successfully

Dear {{ $user->name }},

We are pleased to inform you that your account has been successfully verified. You can now fully access all the features and services provided by our platform.

Account Information:
- Name: {{ $user->name }}
- Email: {{ $user->email }}

If you have any questions or need further assistance, please feel free to contact our support team at {{ env('MAIL_FROM_ADDRESS') }}.

<x-mail::button :url="route('login')">
    Click here to login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
