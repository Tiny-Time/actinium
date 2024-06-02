@props(['event'])

@if (
    $event->check_in_time ||
        $event->party_end_time ||
        $event->address ||
        $event->country ||
        $event->state ||
        $event->contact_phone_number ||
        $event->contact_email_address ||
        $event->contact_name)
    <div class="mt-4 text-lg text-center text-white">
        <h3 class="text-2xl font-bold text-center md:text-3xl">Event Details</h3>
        @if ($event->check_in_time)
            <p class="mt-2"><strong>Check-In Time:</strong> {{ $event->check_in_time }}</p>
        @endif

        @if ($event->party_end_time)
            <p><strong>Party End Time:</strong> {{ $event->party_end_time }}</p>
        @endif

        @if ($event->address || $event->country || $event->state)
            <div>
                <p><strong>Location:
                    </strong>{{ $event->address }}{{ empty($event->state) ? '' : ", $event->state" }}{{ empty($event->country) ? '' : ", $event->country" }}
                </p>
            </div>
        @endif

        @if ($event->contact_name)
            <p>Contact Name: {{ $event->contact_name }}</p>
        @endif

        @if ($event->contact_phone_number)
            <p>Contact Phone: {{ $event->contact_phone_number }}</p>
        @endif

        @if ($event->contact_email_address)
            <p>Contact Email: <a
                    href="mailto:{{ $event->contact_email_address }}">{{ $event->contact_email_address }}</a>
            </p>
        @endif
    </div>
@endif
