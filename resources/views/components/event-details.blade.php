@props(['event'])

@if (
    $event->check_in_time ||
        $event->event_end_time ||
        $event->address ||
        $event->country ||
        $event->state ||
        $event->contact_phone_number ||
        $event->contact_email_address ||
        $event->contact_name)
    <div class="mt-4 text-lg text-center text-white" id="toz-event-details" x-data="{
        startTime: window.eventStartEndTime(@js(\Carbon\Carbon::parse($event->date_time)->format('Y-m-d H:i:s')), @js($event->timezone)),
        endTime: window.eventStartEndTime(@js(\Carbon\Carbon::parse($event->event_end_time)->format('Y-m-d H:i:s')), @js($event->timezone)),
        checkinTime: window.eventStartEndTime(@js(\Carbon\Carbon::parse($event->check_in_time)->format('Y-m-d H:i:s')), @js($event->timezone))
    }">
    <h3 class="text-2xl font-bold text-center title-color md:text-3xl">Event Details</h3>
        @if ($event->date_time)
            <p class="mt-2"><span class="font-bold title-color">Event Date and Time:</span> <span x-text="startTime"></span></p>
        @endif

        @if ($event->check_in_time)
            <p class=""><span class="font-bold title-color">Check-In Time:</span> <span x-text="checkinTime"></span>
            </p>
        @endif

        @if ($event->event_end_time)
            <p><span class="font-bold title-color">Event End Time:</span> <span x-text="endTime"></span></p>
        @endif


        @if ($event->address || $event->country || $event->state)
            <div>
                <p><span class="font-bold title-color">Location:
                    </span>{{ $event->address }}{{ empty($event->state) ? '' : ", $event->state" }}{{ empty($event->country) ? '' : ", $event->country" }}
                </p>
            </div>
        @endif

        @if ($event->contact_name)
            <p><span class="font-bold title-color">Contact Name: </span> {{ $event->contact_name }}</p>
        @endif

        @if ($event->contact_phone_number)
            <p><span class="font-bold title-color">Contact Phone: </span> {{ $event->contact_phone_number }}</p>
        @endif

        @if ($event->contact_email_address)
            <p><span class="font-bold title-color">Contact Email: </span> <a
                    href="mailto:{{ $event->contact_email_address }}">{{ $event->contact_email_address }}</a>
            </p>
        @endif
    </div>
@endif
