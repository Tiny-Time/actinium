<x-mail::message>
    # Unsubscribe Confirmation

    Dear Subscriber,

    We're sorry to see you go, but we've successfully processed your unsubscribe request.

    You have been removed from our newsletter subscription list.

    If you ever change your mind and want to rejoin our community, you can subscribe again at any time. We'd love to
    have you back!

    <x-mail::button :url="$subscribe_link">
        Subscribe
    </x-mail::button>

    If you have any questions or need further assistance, please don't hesitate to contact our support team. We're here
    to help.

    Thank you for being part of our community, and we hope to see you again in the future.

    Best regards,<br>
    {{ config('app.name') }}
</x-mail::message>
