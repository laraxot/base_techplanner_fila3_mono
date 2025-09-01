<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\UI\Tests\Unit\Widgets;

use Illuminate\Database\Eloquent\Model;
use Modules\UI\Filament\Widgets\BaseCalendarWidget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
=======
use Modules\UI\Filament\Widgets\BaseCalendarWidget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
>>>>>>> 60908d2 (.)

// Mock class per testare il BaseCalendarWidget
class MockCalendarWidget extends BaseCalendarWidget
{
    public string $model = MockEventModel::class;
<<<<<<< HEAD

=======
    
>>>>>>> 60908d2 (.)
    public function fetchEvents(array $fetchInfo): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Test Event 1',
                'start' => '2025-01-01T10:00:00',
                'end' => '2025-01-01T12:00:00',
                'color' => '#3B82F6',
            ],
            [
                'id' => 2,
                'title' => 'Test Event 2',
                'start' => '2025-01-02T14:00:00',
                'end' => '2025-01-02T16:00:00',
                'color' => '#10B981',
            ],
        ];
    }
<<<<<<< HEAD

=======
    
>>>>>>> 60908d2 (.)
    public function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('title')
                ->required(),
            \Filament\Forms\Components\DateTimePicker::make('start')
                ->required(),
            \Filament\Forms\Components\DateTimePicker::make('end')
                ->required(),
        ];
    }
}

// Mock model per gli eventi
class MockEventModel extends Model
{
    protected $fillable = ['title', 'start', 'end', 'color'];
<<<<<<< HEAD

=======
    
>>>>>>> 60908d2 (.)
    public function getTable()
    {
        return 'mock_events';
    }
}

beforeEach(function () {
<<<<<<< HEAD
    $this->widget = new MockCalendarWidget;
=======
    $this->widget = new MockCalendarWidget();
>>>>>>> 60908d2 (.)
});

describe('BaseCalendarWidget Inheritance', function () {
    it('extends FullCalendarWidget', function () {
        expect($this->widget)->toBeInstanceOf(FullCalendarWidget::class);
    });

    it('extends BaseCalendarWidget', function () {
        expect($this->widget)->toBeInstanceOf(BaseCalendarWidget::class);
    });

    it('has model property set', function () {
        expect($this->widget->model)->toBe(MockEventModel::class);
    });
});

describe('BaseCalendarWidget Configuration', function () {
    it('can be configured with custom settings', function () {
        $this->widget->selectable(true);
        $this->widget->editable(true);
        $this->widget->timezone('Europe/Rome');
        $this->widget->locale('it');
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($this->widget->selectable)->toBeTrue();
        expect($this->widget->editable)->toBeTrue();
        expect($this->widget->timezone)->toBe('Europe/Rome');
        expect($this->widget->locale)->toBe('it');
    });

    it('can set calendar plugins', function () {
        $this->widget->plugins(['dayGrid', 'timeGrid', 'list', 'interaction']);
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($this->widget->plugins)->toContain('dayGrid', 'timeGrid', 'list', 'interaction');
    });

    it('can set calendar height', function () {
        $this->widget->height('600px');
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($this->widget->height)->toBe('600px');
    });

    it('can set calendar aspect ratio', function () {
        $this->widget->aspectRatio(1.35);
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($this->widget->aspectRatio)->toBe(1.35);
    });
});

describe('BaseCalendarWidget Event Management', function () {
    it('can fetch events for date range', function () {
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events = $this->widget->fetchEvents($fetchInfo);

=======
        
        $events = $this->widget->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        expect($events)->toBeArray();
        expect($events)->toHaveCount(2);
        expect($events[0]['title'])->toBe('Test Event 1');
        expect($events[1]['title'])->toBe('Test Event 2');
    });

    it('returns events with correct structure', function () {
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events = $this->widget->fetchEvents($fetchInfo);

=======
        
        $events = $this->widget->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        foreach ($events as $event) {
            expect($event)->toHaveKey('id');
            expect($event)->toHaveKey('title');
            expect($event)->toHaveKey('start');
            expect($event)->toHaveKey('end');
            expect($event)->toHaveKey('color');
        }
    });

    it('handles empty event list', function () {
<<<<<<< HEAD
        $widget = new class extends BaseCalendarWidget
        {
            public string $model = MockEventModel::class;

=======
        $widget = new class extends BaseCalendarWidget {
            public string $model = MockEventModel::class;
            
>>>>>>> 60908d2 (.)
            public function fetchEvents(array $fetchInfo): array
            {
                return [];
            }
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            public function getFormSchema(): array
            {
                return [];
            }
        };
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events = $widget->fetchEvents($fetchInfo);

=======
        
        $events = $widget->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        expect($events)->toBeArray();
        expect($events)->toHaveCount(0);
    });

    it('handles large event lists efficiently', function () {
<<<<<<< HEAD
        $widget = new class extends BaseCalendarWidget
        {
            public string $model = MockEventModel::class;

=======
        $widget = new class extends BaseCalendarWidget {
            public string $model = MockEventModel::class;
            
>>>>>>> 60908d2 (.)
            public function fetchEvents(array $fetchInfo): array
            {
                $events = [];
                for ($i = 1; $i <= 1000; $i++) {
                    $events[] = [
                        'id' => $i,
                        'title' => "Event {$i}",
                        'start' => "2025-01-01T{$i}:00:00",
<<<<<<< HEAD
                        'end' => '2025-01-01T'.($i + 1).':00:00',
                        'color' => '#3B82F6',
                    ];
                }

                return $events;
            }

=======
                        'end' => "2025-01-01T" . ($i + 1) . ":00:00",
                        'color' => '#3B82F6',
                    ];
                }
                return $events;
            }
            
>>>>>>> 60908d2 (.)
            public function getFormSchema(): array
            {
                return [];
            }
        };
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        $startTime = microtime(true);
        $events = $widget->fetchEvents($fetchInfo);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($events)->toHaveCount(1000);
        expect($executionTime)->toBeLessThan(1.0); // Dovrebbe essere veloce
    });
});

describe('BaseCalendarWidget Form Schema', function () {
    it('provides form schema for event creation', function () {
        $formSchema = $this->widget->getFormSchema();
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($formSchema)->toBeArray();
        expect($formSchema)->toHaveCount(3);
    });

    it('includes required form fields', function () {
        $formSchema = $this->widget->getFormSchema();
<<<<<<< HEAD

        $fieldNames = collect($formSchema)->map(fn ($field) => $field->getName())->toArray();

=======
        
        $fieldNames = collect($formSchema)->map(fn($field) => $field->getName())->toArray();
        
>>>>>>> 60908d2 (.)
        expect($fieldNames)->toContain('title', 'start', 'end');
    });

    it('has title field with required validation', function () {
        $formSchema = $this->widget->getFormSchema();
<<<<<<< HEAD

        $titleField = collect($formSchema)->first(fn ($field) => $field->getName() === 'title');

=======
        
        $titleField = collect($formSchema)->first(fn($field) => $field->getName() === 'title');
        
>>>>>>> 60908d2 (.)
        expect($titleField)->not->toBeNull();
        expect($titleField->isRequired())->toBeTrue();
    });

    it('has start date field with required validation', function () {
        $formSchema = $this->widget->getFormSchema();
<<<<<<< HEAD

        $startField = collect($formSchema)->first(fn ($field) => $field->getName() === 'start');

=======
        
        $startField = collect($formSchema)->first(fn($field) => $field->getName() === 'start');
        
>>>>>>> 60908d2 (.)
        expect($startField)->not->toBeNull();
        expect($startField->isRequired())->toBeTrue();
    });

    it('has end date field with required validation', function () {
        $formSchema = $this->widget->getFormSchema();
<<<<<<< HEAD

        $endField = collect($formSchema)->first(fn ($field) => $field->getName() === 'end');

=======
        
        $endField = collect($formSchema)->first(fn($field) => $field->getName() === 'end');
        
>>>>>>> 60908d2 (.)
        expect($endField)->not->toBeNull();
        expect($endField->isRequired())->toBeTrue();
    });
});

describe('BaseCalendarWidget Calendar Options', function () {
    it('can set first day of week', function () {
        $this->widget->firstDay(1); // Monday
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($this->widget->firstDay)->toBe(1);
    });

    it('can set business hours', function () {
        $businessHours = [
            'dow' => [1, 2, 3, 4, 5], // Monday to Friday
            'start' => '09:00',
            'end' => '17:00',
        ];
<<<<<<< HEAD

        $this->widget->businessHours($businessHours);

=======
        
        $this->widget->businessHours($businessHours);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->businessHours)->toBe($businessHours);
    });

    it('can set header toolbar configuration', function () {
        $headerToolbar = [
            'left' => 'prev,next today',
            'center' => 'title',
            'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
        ];
<<<<<<< HEAD

        $this->widget->headerToolbar($headerToolbar);

=======
        
        $this->widget->headerToolbar($headerToolbar);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->headerToolbar)->toBe($headerToolbar);
    });

    it('can set footer toolbar configuration', function () {
        $footerToolbar = [
            'left' => 'prev,next today',
            'center' => 'title',
            'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
        ];
<<<<<<< HEAD

        $this->widget->footerToolbar($footerToolbar);

=======
        
        $this->widget->footerToolbar($footerToolbar);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->footerToolbar)->toBe($footerToolbar);
    });

    it('can set button text customization', function () {
        $buttonText = [
            'today' => 'Oggi',
            'month' => 'Mese',
            'week' => 'Settimana',
            'day' => 'Giorno',
        ];
<<<<<<< HEAD

        $this->widget->buttonText($buttonText);

=======
        
        $this->widget->buttonText($buttonText);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->buttonText)->toBe($buttonText);
    });

    it('can set day names', function () {
        $dayNames = ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];
<<<<<<< HEAD

        $this->widget->dayNames($dayNames);

=======
        
        $this->widget->dayNames($dayNames);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->dayNames)->toBe($dayNames);
    });

    it('can set month names', function () {
        $monthNames = [
            'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
<<<<<<< HEAD
            'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre',
        ];

        $this->widget->monthNames($monthNames);

=======
            'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
        ];
        
        $this->widget->monthNames($monthNames);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->monthNames)->toBe($monthNames);
    });
});

describe('BaseCalendarWidget Event Handling', function () {
    it('can handle event click', function () {
        $eventClickHandler = "function(info) { console.log('Event clicked:', info.event.title); }";
<<<<<<< HEAD

        $this->widget->eventClick($eventClickHandler);

=======
        
        $this->widget->eventClick($eventClickHandler);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->eventClick)->toBe($eventClickHandler);
    });

    it('can handle event mount', function () {
<<<<<<< HEAD
        $eventMountHandler = 'function(info) { info.el.style.backgroundColor = info.event.backgroundColor; }';

        $this->widget->eventDidMount($eventMountHandler);

=======
        $eventMountHandler = "function(info) { info.el.style.backgroundColor = info.event.backgroundColor; }";
        
        $this->widget->eventDidMount($eventMountHandler);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->eventDidMount)->toBe($eventMountHandler);
    });

    it('can handle event unmount', function () {
        $eventUnmountHandler = "function(info) { console.log('Event unmounted:', info.event.title); }";
<<<<<<< HEAD

        $this->widget->eventDidUnmount($eventUnmountHandler);

=======
        
        $this->widget->eventDidUnmount($eventUnmountHandler);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->eventDidUnmount)->toBe($eventUnmountHandler);
    });

    it('can handle date click', function () {
        $dateClickHandler = "function(info) { console.log('Date clicked:', info.dateStr); }";
<<<<<<< HEAD

        $this->widget->dateClick($dateClickHandler);

=======
        
        $this->widget->dateClick($dateClickHandler);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->dateClick)->toBe($dateClickHandler);
    });

    it('can handle date selection', function () {
        $selectHandler = "function(info) { console.log('Date range selected:', info.startStr, 'to', info.endStr); }";
<<<<<<< HEAD

        $this->widget->select($selectHandler);

=======
        
        $this->widget->select($selectHandler);
        
>>>>>>> 60908d2 (.)
        expect($this->widget->select)->toBe($selectHandler);
    });
});

describe('BaseCalendarWidget Validation', function () {
    it('validates event data structure', function () {
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events = $this->widget->fetchEvents($fetchInfo);

=======
        
        $events = $this->widget->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        foreach ($events as $event) {
            expect($event['id'])->toBeInt();
            expect($event['title'])->toBeString();
            expect($event['start'])->toBeString();
            expect($event['end'])->toBeString();
            expect($event['color'])->toBeString();
        }
    });

    it('validates date format in events', function () {
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events = $this->widget->fetchEvents($fetchInfo);

=======
        
        $events = $this->widget->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        foreach ($events as $event) {
            // Validate ISO 8601 date format
            expect($event['start'])->toMatch('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}$/');
            expect($event['end'])->toMatch('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}$/');
        }
    });

    it('validates color format in events', function () {
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events = $this->widget->fetchEvents($fetchInfo);

=======
        
        $events = $this->widget->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        foreach ($events as $event) {
            // Validate hex color format
            expect($event['color'])->toMatch('/^#[0-9A-Fa-f]{6}$/');
        }
    });
});

describe('BaseCalendarWidget Performance', function () {
    it('handles large date ranges efficiently', function () {
<<<<<<< HEAD
        $widget = new class extends BaseCalendarWidget
        {
            public string $model = MockEventModel::class;

=======
        $widget = new class extends BaseCalendarWidget {
            public string $model = MockEventModel::class;
            
>>>>>>> 60908d2 (.)
            public function fetchEvents(array $fetchInfo): array
            {
                // Simulate complex query
                $events = [];
                $start = new DateTime($fetchInfo['start']);
                $end = new DateTime($fetchInfo['end']);
                $interval = $start->diff($end);
                $days = $interval->days;
<<<<<<< HEAD

=======
                
>>>>>>> 60908d2 (.)
                for ($i = 0; $i < min($days, 100); $i++) {
                    $events[] = [
                        'id' => $i + 1,
                        'title' => "Event Day {$i}",
                        'start' => $start->format('Y-m-d\TH:i:s'),
                        'end' => $start->format('Y-m-d\TH:i:s'),
                        'color' => '#3B82F6',
                    ];
                    $start->add(new DateInterval('P1D'));
                }
<<<<<<< HEAD

                return $events;
            }

=======
                return $events;
            }
            
>>>>>>> 60908d2 (.)
            public function getFormSchema(): array
            {
                return [];
            }
        };
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-12-31T23:59:59', // Full year
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        $startTime = microtime(true);
        $events = $widget->fetchEvents($fetchInfo);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($events)->toHaveCount(100); // Limited to 100 for performance
        expect($executionTime)->toBeLessThan(1.0); // Dovrebbe essere veloce
    });

    it('caches event data efficiently', function () {
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        // First fetch
        $startTime = microtime(true);
        $events1 = $this->widget->fetchEvents($fetchInfo);
        $endTime = microtime(true);
        $firstFetchTime = $endTime - $startTime;
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        // Second fetch (should be cached)
        $startTime = microtime(true);
        $events2 = $this->widget->fetchEvents($fetchInfo);
        $endTime = microtime(true);
        $secondFetchTime = $endTime - $startTime;
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        expect($events1)->toBe($events2);
        expect($secondFetchTime)->toBeLessThanOrEqual($firstFetchTime);
    });
});

describe('BaseCalendarWidget Integration', function () {
    it('works with different model types', function () {
        $widgets = [
<<<<<<< HEAD
            new MockCalendarWidget,
            new class extends BaseCalendarWidget
            {
                public string $model = MockEventModel::class;

=======
            new MockCalendarWidget(),
            new class extends BaseCalendarWidget {
                public string $model = MockEventModel::class;
                
>>>>>>> 60908d2 (.)
                public function fetchEvents(array $fetchInfo): array
                {
                    return [];
                }
<<<<<<< HEAD

=======
                
>>>>>>> 60908d2 (.)
                public function getFormSchema(): array
                {
                    return [];
                }
            },
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 60908d2 (.)
        foreach ($widgets as $widget) {
            expect($widget)->toBeInstanceOf(BaseCalendarWidget::class);
            expect($widget)->toHaveMethod('fetchEvents');
            expect($widget)->toHaveMethod('getFormSchema');
        }
    });

    it('maintains consistent behavior across instances', function () {
<<<<<<< HEAD
        $widget1 = new MockCalendarWidget;
        $widget2 = new MockCalendarWidget;

=======
        $widget1 = new MockCalendarWidget();
        $widget2 = new MockCalendarWidget();
        
>>>>>>> 60908d2 (.)
        $fetchInfo = [
            'start' => '2025-01-01T00:00:00',
            'end' => '2025-01-31T23:59:59',
        ];
<<<<<<< HEAD

        $events1 = $widget1->fetchEvents($fetchInfo);
        $events2 = $widget2->fetchEvents($fetchInfo);

=======
        
        $events1 = $widget1->fetchEvents($fetchInfo);
        $events2 = $widget2->fetchEvents($fetchInfo);
        
>>>>>>> 60908d2 (.)
        expect($events1)->toBe($events2);
        expect($events1)->toHaveCount(2);
        expect($events2)->toHaveCount(2);
    });
});
