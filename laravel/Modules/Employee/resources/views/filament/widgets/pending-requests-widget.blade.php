<<<<<<< HEAD
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
            {{-- Modern Pending Requests List --}}
=======
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
>>>>>>> cda86dd (.)
            <div class="space-y-4">
                @foreach($pendingRequests as $request)
                    @php
                        $typeConfig = $this->getRequestTypeConfig($request['type']);
<<<<<<< HEAD
                        $daysPending = $request['submitted_date']->diffInDays(now());
                        $isUrgent = $daysPending > 7 || $request['priority'] === 'high';
                    @endphp
                    
                    <div class="group relative p-4 rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 bg-white transform hover:-translate-y-0.5">
                        <div class="flex items-start space-x-4">
                            {{-- Request Icon --}}
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-xl {{ $typeConfig['bg'] }} shadow-sm group-hover:shadow-md transition-shadow">
                                    <x-dynamic-component :component="$typeConfig['icon']" class="w-5 h-5 {{ $typeConfig['color'] }}" />
                                </div>
                            </div>

                            {{-- Request Details --}}
                            <div class="flex-1 min-w-0">
                                {{-- Header with title and badges --}}
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="text-base font-semibold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                        {{ $request['title'] }}
                                    </h4>
                                    {{-- Status Badge --}}
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getStatusBadgeColor($request['status']) }}">
                                        {{ __('employee::widgets.pending_requests.status.' . $request['status']) }}
                                    </span>
                                    {{-- Priority Badge --}}
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getPriorityBadgeColor($request['priority']) }}">
                                        {{ __('employee::widgets.pending_requests.priority.' . $request['priority']) }}
                                    </span>
                                </div>

                                {{-- Description --}}
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ $request['description'] }}
                                </p>

                                {{-- Metadata --}}
                                <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                    {{-- Submitted Date --}}
                                    <span class="flex items-center gap-1">
                                        <x-heroicon-o-calendar class="w-3.5 h-3.5" />
                                        {{ $request['submitted_date']->format('d/m/Y') }}
                                    </span>

                                    {{-- Approver --}}
                                    <span class="flex items-center gap-1">
                                        <x-heroicon-o-user class="w-3.5 h-3.5" />
                                        {{ $request['approver'] }}
                                    </span>

                                    {{-- Days Pending --}}
                                    <span class="flex items-center gap-1 {{ $isUrgent ? 'text-red-600 font-medium' : '' }}">
                                        <x-heroicon-o-clock class="w-3.5 h-3.5" />
                                        {{ $daysPending }} {{ __('employee::widgets.pending_requests.days_pending') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex-shrink-0 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="inline-flex items-center px-3 py-1.5 border border-gray-200 text-xs font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 transition-colors shadow-sm">
                                    <x-heroicon-o-eye class="w-3.5 h-3.5 mr-1" />
                                    {{ __('employee::widgets.pending_requests.view') }}
                                </button>
                                <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 hover:text-red-800 transition-colors">
                                    <x-heroicon-o-x-mark class="w-3.5 h-3.5 mr-1" />
                                    {{ __('employee::widgets.pending_requests.cancel') }}
                                </button>
                            </div>
=======
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
>>>>>>> cda86dd (.)
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Footer with View All Link --}}
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="text-center">
                    <a 
                        href="#" 
<<<<<<< HEAD
                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-500 font-medium transition-colors"
                    >
                        {{ __('employee::widgets.pending_requests.view_all') }}
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
=======
                        class="text-sm text-blue-600 hover:text-blue-500 font-medium"
                    >
                        {{ __('employee::widgets.pending_requests.view_all') }} →
>>>>>>> cda86dd (.)
                    </a>
                </div>
            </div>
        @else
<<<<<<< HEAD
            {{-- Modern Empty State --}}
            <div class="text-center py-16 px-6">
                {{-- Modern Illustration --}}
                <div class="mx-auto h-32 w-32 mb-6">
                    <svg class="w-full h-full text-green-400" viewBox="0 0 100 100" fill="none">
                        <circle cx="50" cy="50" r="40" class="stroke-current stroke-2 fill-green-50" />
                        <path d="M40 50 L45 58 L60 42" class="stroke-current stroke-3 fill-none" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="30" cy="30" r="5" class="fill-green-200 animate-pulse" />
                        <circle cx="70" cy="25" r="3" class="fill-green-300 animate-pulse delay-150" />
                        <circle cx="20" cy="60" r="4" class="fill-green-200 animate-pulse delay-300" />
                    </svg>
                </div>

                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    {{ __('employee::widgets.pending_requests.empty_state.title') }}
                </h3>
                <p class="text-sm text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">
                    {{ __('employee::widgets.pending_requests.empty_state.description') }}
                </p>

=======
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

>>>>>>> cda86dd (.)
                {{-- Action Button --}}
                <div class="flex justify-center">
                    <a 
                        href="#" 
<<<<<<< HEAD
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg"
                    >
                        <x-heroicon-o-plus class="w-5 h-5 mr-2" />
=======
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <x-heroicon-o-plus class="w-4 h-4 mr-2" />
>>>>>>> cda86dd (.)
                        {{ __('employee::widgets.pending_requests.new_request') }}
                    </a>
                </div>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
