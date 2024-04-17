<?php

namespace App\Livewire;

use App\Models\Event;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;
use AndreasElia\Analytics\Models\PageView;

class EventDevices extends ChartWidget
{
    protected static ?string $heading = 'Devices';

    protected static ?string $maxHeight = '250px';

    public ?Model $record = null;

    public function mount(): void {
        $this->record = Event::find(request()->record);
    }

    protected function getData(): array
    {
        $event_id = $this->record->event_id;

        return [
            'datasets' => [
                [
                    'label' => 'Devices',
                    'data' => [
                        PageView::where('uri', '/event/'.$event_id)->where('device', 'desktop')->count(),
                        PageView::where('uri', '/event/'.$event_id)->where('device', 'other')->count()
                    ],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                ],
            ],
            'labels' => ['Desktop', 'Mobile'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
