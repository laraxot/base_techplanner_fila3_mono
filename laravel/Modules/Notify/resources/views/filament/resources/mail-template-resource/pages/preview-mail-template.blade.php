<x-filament-panels::page>
    <div class="space-y-6">
        <div class="p-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('notify::mail.template.preview.subject') }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $this->record->subject }}
            </p>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('notify::mail.template.preview.body_html') }}
            </h3>
            <div class="mt-1 prose max-w-none">
                {!! $this->record->body_html !!}
            </div>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('notify::mail.template.preview.body_text') }}
            </h3>
            <pre class="mt-1 text-sm text-gray-600 whitespace-pre-wrap">{{ $this->record->body_text }}</pre>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('notify::mail.template.preview.variables') }}
            </h3>
            <div class="mt-1">
                <x-filament::grid>
                    @foreach($this->record->variables as $key => $value)
                        <x-filament::grid.column>
                            <div class="p-2 bg-gray-50 rounded">
                                <span class="font-medium">{{ $key }}:</span>
                                <span class="text-gray-600">{{ $value }}</span>
                            </div>
                        </x-filament::grid.column>
                    @endforeach
                </x-filament::grid>
            </div>
        </div>
    </div>
</x-filament-panels::page> 