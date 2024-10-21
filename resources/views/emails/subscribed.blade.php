<x-mail::message>
    # Subscription Confirmation

    Dear Subscriber,

    Thank you for subscribing to our newsletter. You're now part of our community, and we're excited to have you on
    board!

    Here's a quick overview of what you can expect:

    - Regular updates on our latest products and services.
    - Exclusive offers and promotions for our subscribers.
    - Valuable insights and tips related to your interests.

    If you have any questions or need assistance, feel free to reply to this email or contact our support team. We're
    here to help!

    Stay tuned for our upcoming newsletters, and enjoy being part of our community.

    You can unsubscribe anytime by clicking on the button below:

    <x-mail::button :url="$unsubscribe_link">
        Unsubscribe
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
