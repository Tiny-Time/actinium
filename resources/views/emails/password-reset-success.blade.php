<x-mail::message>
    ## Dear {{ $username }},

    We're writing to inform you that your password reset request was successful. Your account's password has been reset,
    and you can now securely access your account using the new password.

    If you did not initiate this password reset request, please contact our support team immediately to ensure the
    security of your account.

    For any further assistance or inquiries, feel free to reach out to our support team. We're here to help!

    Thank you for choosing our services,<br>

    {{ config('app.name') }}
</x-mail::message>
