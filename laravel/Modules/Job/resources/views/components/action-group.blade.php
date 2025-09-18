<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
@php
>>>>>>> de0f89b5 (.)
=======
@php
>>>>>>> 2e199498 (.)
=======
@php
>>>>>>> eaeb6531 (.)
    $actions = $getActions();
@endphp
<div class="grid grid-cols-2 gap-1" style="width: max-content;">
    @foreach ($actions as $action)
        @if (!$action->isHidden())
            {{ $action }}
        @endif
    @endforeach
</div>
