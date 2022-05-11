<div class='title'>{{$item->name}} 
    <div>
        <a href='{!! route('pointer.store').'/'. $item->id !!}/edit'>
            <img src='{{url('/images/edit.svg')}}' width='15' alt='Picto Modifier'>
        </a> 
        @if (Auth::user()->roles()->find(1)) 
            <a 
                href='{!! route('pointer.destroy', $item->id) !!}' 
                onclick="event.preventDefault(); document.getElementById('delete_product_form').submit();"
            >
                <img src='{{url('/images/delete.svg')}}' width='15' alt='Picto Supprimer'>
            </a> 
            <form action='{{ url('/pointer/'.$item->id) }}' method='POST' id='delete_product_form' style="display:none;">
                @csrf 
                <input type='hidden' name='_method' value='DELETE'>
                <input type='submit' value='Supprimer' class='btn btn-danger'>
            </form> 
        @endif 
    </div>
</div>
<div class='creator'>
    Créateur : {{$item->creator->username}}
</div>
<div class='price__title'>
    Prix du carburant
</div>
<div class='cards__essence space-between'>
    @if (!empty($item->Gazoil))
        <div class='card__essence'>
            <img src='{{url('/images/station.svg')}}' width='15' alt='Picto Station Essence'> 
            <div class='card__essence__content'>
                <label for='price_gazole'class='card__essence__title'>Gazole</label>
                {{ $item->Gazoil }}
            </div>
        </div>
    @endif 
    @if (!empty($item->E85))
        <div class='card__essence'>
            <img src='{{url('/images/station.svg')}}' width='15' alt='Picto Station Essence'>
            <div class='card__essence__content'>
                <label class='card__essence__title'>E85</label>
                {{ $item->E85 }}
            </div>
        </div>
    @endif 
    @if (!empty($item->SP95))
        <div class='card__essence'>
            <img src='{{url('/images/station.svg')}}' width='15' alt='Picto Station Essence'>
            <div class='card__essence__content'>
                <label class='card__essence__title'>SP95</label>
                {{ $item->SP95 }}
            </div>
        </div>
    @endif 
    @if (!empty($item->SP98))
        <div class='card__essence'>
            <img src='{{url('/images/station.svg')}}' width='15' alt='Picto Station Essence'> 
            <div class='card__essence__content'>
                <label class='card__essence__title'>SP98</label>
                {{ $item->SP98 }}
            </div>
        </div>
    @endif
</div>