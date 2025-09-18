<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<div>

>>>>>>> de0f89b5 (.)
=======
<div>

>>>>>>> 2e199498 (.)
=======
<div>

>>>>>>> eaeb6531 (.)
    @php
    /*
    dd([
        'getstate'=>$getState(),
        '$getRecord()'=>$getRecord(),
        'get_defined_vars()'=>get_defined_vars(),
    ]);
    */
    @endphp
    <ul>
    @foreach ($getState() as $key=>$value)
        @include('job::filament.tables.columns.array.item',['key'=>$key,'value'=>$value])
    @endforeach
    </ul>
</div>