{{-- PendingRequestsWidget View - Employee Request Status --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('employee::widgets.pending_requests.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('employee::widgets.pending_requests.description') }}
        </x-slot>

        @if(count($pendingRequests) > 0)
            {{-- Pending Requests List --}}
            <div class="space-y-4">
                @foreach($pendingRequests as $request)
                    @php
                        $typeConfig = $this->getRequestTypeConfig($request['type']);
                    @endphp
                    
                    <div class="flex items-start space-x-4 p-4 rounded-lg border {{ $typeConfig['bg'] }} {{ $typeConfig['border'] }} hover:shadow-sm transition-shadow">
                        {{-- Request Icon --}}
                        <div class="flex-shrink-0 mt-1">
                            <div class="p-2 rounded-full {{ $typeConfig['bg'] }}">
                                <x-dynamic-component :component="$typeConfig['icon']" class="w-5 h-5 {{ $typeConfig['color'] }}" />
                            </div>
                        </div>

                        {{-- Request Details --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">
                                        {{ $request['title'] }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $request['description'] }}
                                    </p>
                                    
                                    <div class="flex items-center space-x-4 mt-3">
                                        {{-- Status Badge --}}
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getStatusBadgeColor($request['status']) }}">
                                            {{ __('employee::widgets.pending_requests.status.' . $request['status']) }}
                                        </span>
                                        
                                        {{-- Priority Badge --}}
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getPriorityBadgeColor($request['priority']) }}">
                                            {{ __('employee::widgets.pending_requests.priority.' . $request['priority']) }}
                                        </span>
                                    </div>

                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        {{-- Submitted Date --}}
                                        <span class="flex items-center">
                                            <x-heroicon-o-calendar class="w-4 h-4 mr-1" />
                                            {{ __('employee::widgets.pending_requests.submitted') }}: {{ $request['submitted_date']->format('d/m/Y') }}
                                        </span>

                                        {{-- Approver --}}
                                        <span class="flex items-center">
                                            <x-heroicon-o-user class="w-4 h-4 mr-1" />
                                            {{ __('employee::widgets.pending_requests.approver') }}: {{ $request['approver'] }}
                                        </span>

                                        {{-- Days Pending --}}
                                        <span class="flex items-center">
                                            <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                            {{ $request['submitted_date']->diffInDays(now()) }} {{ __('employee::widgets.pending_requests.days_pending') }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex-shrink-0 ml-4 flex space-x-2">
                                    <button class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        {{ __('employee::widgets.pending_requests.view') }}
                                    </button>
                                    <button class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('employee::widgets.pending_requests.cancel') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Footer with View All Link --}}
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="text-center">
                    <a 
                        href="#" 
                        class="text-sm text-blue-600 hover:text-blue-500 font-medium"
                    >
                        {{ __('employee::widgets.pending_requests.view_all') }} →
                    </a>
                </div>
            </div>
        @else
            {{-- Empty State - All Requests Managed --}}
            <div class="text-center py-12">
                {{-- Animated SVG Illustration --}}
                <div class="mx-auto h-24 w-24 mb-4">
                    <svg class="w-full h-full text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2" class="opacity-25"/>
                        <path d="M9 12l2 2 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse"/>
                    </svg>
                </div>

                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    {{ __('employee::widgets.pending_requests.empty_state.title') }}
                </h3>
                <p class="text-sm text-gray-600 mb-6 max-w-sm mx-auto">
                    {{ __('employee::widgets.pending_requests.empty_state.description') }}
                </p>

                {{-- Character Illustration --}}
                <div class="mx-auto h-32 w-32 mb-6">
                    <svg class="w-full h-full text-blue-400" fill="currentColor" viewBox="0 0 100 100">
                        {{-- Simple character illustration --}}
                        <circle cx="50" cy="30" r="12" class="text-blue-300"/>
                        <rect x="40" y="42" width="20" height="30" rx="10" class="text-blue-400"/>
                        <rect x="35" y="48" width="8" height="15" rx="4" class="text-blue-300"/>
                        <rect x="57" y="48" width="8" height="15" rx="4" class="text-blue-300"/>
                        <rect x="45" y="72" width="4" height="20" rx="2" class="text-blue-300"/>
                        <rect x="51" y="72" width="4" height="20" rx="2" class="text-blue-300"/>
                        {{-- Thumbs up --}}
                        <circle cx="70" cy="45" r="3" class="text-green-500"/>
                        <rect x="68" y="48" width="4" height="8" rx="2" class="text-green-500"/>
                    </svg>
                </div>

                {{-- Action Button --}}
                <div class="flex justify-center">
                    <a 
                        href="#" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                        {{ __('employee::widgets.pending_requests.new_request') }}
                    </a>
                </div>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
