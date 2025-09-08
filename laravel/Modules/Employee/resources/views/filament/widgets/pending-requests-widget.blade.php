{{-- PendingRequestsWidget View - Employee Request Status (Compact Design) --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <span>{{ __('employee::widgets.pending_requests.title') }}</span>
                @if(count($pendingRequests) > 0)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        {{ count($pendingRequests) }}
                    </span>
                @endif
            </div>
        </x-slot>

        @if(count($pendingRequests) > 0)
            {{-- Compact Pending Requests List --}}
            <div class="space-y-3">
                @foreach($pendingRequests as $request)
                    @php
                        $typeConfig = $this->getRequestTypeConfig($request['type']);
                    @endphp
                    
                    <div class="group relative p-3 rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all duration-200 bg-white">
                        <div class="flex items-start space-x-3">
                            {{-- Request Icon --}}
                            <div class="flex-shrink-0">
                                <div class="p-2 rounded-lg {{ $typeConfig['bg'] }}">
                                    <x-dynamic-component :component="$typeConfig['icon']" class="w-4 h-4 {{ $typeConfig['color'] }}" />
                                </div>
                            </div>

                            {{-- Request Details --}}
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">
                                    {{ $request['title'] }}
                                </h4>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                    {{ $request['description'] }}
                                </p>
                                
                                {{-- Status and Priority in one line --}}
                                <div class="flex items-center space-x-2 mt-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $this->getStatusBadgeColor($request['status']) }}">
                                        {{ __('employee::widgets.pending_requests.status.' . $request['status']) }}
                                    </span>
                                    @if($request['priority'] === 'high')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $this->getPriorityBadgeColor($request['priority']) }}">
                                            {{ __('employee::widgets.pending_requests.priority.' . $request['priority']) }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Days Pending --}}
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <x-heroicon-o-clock class="w-3 h-3 mr-1" />
                                    {{ $request['submitted_date']->diffInDays(now()) }} {{ __('employee::widgets.pending_requests.days_pending') }}
                                </div>
                            </div>

                            {{-- Quick Action --}}
                            <div class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Compact Footer --}}
            <div class="mt-4 pt-3 border-t border-gray-100">
                <a 
                    href="#" 
                    class="flex items-center justify-center text-sm text-blue-600 hover:text-blue-500 font-medium py-2 rounded-md hover:bg-blue-50 transition-colors"
                >
                    {{ __('employee::widgets.pending_requests.view_all') }}
                    <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
                </a>
            </div>
        @else
            {{-- Compact Empty State --}}
            <div class="text-center py-8">
                {{-- Success Icon --}}
                <div class="mx-auto h-16 w-16 mb-4">
                    <div class="h-full w-full rounded-full bg-green-100 flex items-center justify-center">
                        <x-heroicon-o-check-circle class="w-8 h-8 text-green-600" />
                    </div>
                </div>

                <h3 class="text-sm font-medium text-gray-900 mb-2">
                    {{ __('employee::widgets.pending_requests.empty_state.title') }}
                </h3>
                <p class="text-xs text-gray-600 mb-4">
                    {{ __('employee::widgets.pending_requests.empty_state.description') }}
                </p>

                {{-- New Request Button --}}
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <x-heroicon-o-plus class="w-3 h-3 mr-1" />
                    {{ __('employee::widgets.pending_requests.new_request') }}
                </button>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
