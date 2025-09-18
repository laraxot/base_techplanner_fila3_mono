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
    /*
    try{
        $val=@unserialize($value);
    }catch(\TypeError $e){
        $val=$value;
    }
    $value=$val;
    */
@endphp

<li><b>{{ $key }}</b>:
    @if (is_iterable($value))
        <ul>
            @foreach ($value as $k=>$v)
                @include('job::filament.tables.columns.array.item',['key'=>$k,'value'=>$v])
            @endforeach
        </ul>
    @else
        {{ $value }}
    @endif
</li>