<header class="bg-white">
	<nav class="px-6 py-4 mx-auto container-xl">
		<ul class="flex items-center justify-between lg:grid lg:grid-cols-3 gap-x-4">
			<li class="flex items-center space-x-8">
				<a href="/">
					<div class="size-8">
						<x-filament-panels::logo class="size-8"/>
					</div>
				</a>
				<div class="items-center hidden space-x-6 md:flex">
					@include('pub_theme::layouts.headernav.markets')
					@include('pub_theme::layouts.headernav.leaderboard')
				</div>
			</li>
			<li class="hidden grow md:block">
				{{ \Filament\Support\Facades\FilamentView::renderHook(\Modules\Predict\Enums\Front\TopBarEnum::TOPBAR_CENTER->value) }}
				{{-- @include('pub_theme::layouts.headernav.search') --}}
			</li>
			<li>
				<div class="flex items-center justify-end gap-x-4">
					{{ \Filament\Support\Facades\FilamentView::renderHook(\Modules\Predict\Enums\Front\TopBarEnum::USER_MENU_BEFORE->value) }}
                    <livewire:lang.switcher />
					{{-- @include('pub_theme::layouts.headernav.language') --}}
					@include('pub_theme::layouts.headernav.auth')
					@include('pub_theme::layouts.headernav.notifications')
					@include('pub_theme::layouts.headernav.about')
				</div>
			</li>
		</ul>
	</nav>
</header>
