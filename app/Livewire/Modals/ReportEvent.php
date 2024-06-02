<?php

namespace App\Livewire\Modals;

use App\Models\Event;
use Livewire\Component;
use App\Models\EventReport;
use Filament\Notifications\Notification;

class ReportEvent extends Component
{
    public $showEventReportModal = false, $report_reason, $event_id, $user_id;

    public function mount(){
        $this->event_id = Event::where('event_id', request()->event_id)->first()?->id;
        $this->user_id = auth()?->user()?->id;
    }

    public function submit(){
        $this->validate([
            'report_reason' => 'required|string|min:30',
        ]);

        EventReport::create([
            'event_id' => $this->event_id,
            'user_id' => $this->user_id,
            'report_reason' => $this->report_reason,
        ]);

        Notification::make()
            ->title('Report submitted successfully.')
            ->success()
            ->send();

        $this->report_reason = '';

        $this->showEventReportModal = false;
    }

    public function render()
    {
        return view('livewire.modals.report-event');
    }
}
