{{-- Vista per il LoginWidget nel tema Sixteen --}}
{{-- Questa vista è ottimizzata per il design del tema Sixteen --}}
{{-- IMPORTANTE: Usa solo componenti Filament esistenti e verificati --}}

<div class="space-y-6">
    {{-- Header del form --}}
    <div class="text-center">
        <h2 class="text-2xl font-extrabold leading-9 text-gray-800 dark:text-gray-200">

        </p>
    </div>

    {{-- Form renderizzato dal widget --}}
    <form wire:submit="login" class="space-y-6">
        {{ $this->form }}

        {{-- Remember Me & Forgot Password --}}
        <div class="flex items-center justify-between mt-6 text-sm leading-5">
            <div class="text-sm">
                <a 
                    href="{{ url('/' . app()->getLocale() . '/auth/password/email') }}" 
                    class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded"
                >

                </a>
            </div>
        </div>

        {{-- Submit Button --}}
        <div>
            <button 
                type="submit" 
                wire:loading.attr="disabled"
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md dark:bg-blue-700 dark:hover:bg-blue-800"
            >
                {{-- Loading Spinner --}}
                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                
                {{-- Login Icon --}}
                <svg wire:loading.remove class="absolute left-0 inset-y-0 flex items-center pl-3 h-5 w-5 text-blue-500 group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                

            </button>
        </div>
    </form>

    {{-- Registration Link --}}
    <div class="mt-6 text-center">
        <div class="text-sm leading-5 text-gray-600 dark:text-gray-400 space-x-0.5">

            <a 
                href="{{ url('/' . app()->getLocale() . '/auth/register') }}" 
                class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded"
            >

            </a>
        </div>
    </div>
</div>
