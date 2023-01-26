@php use Illuminate\Support\Carbon;use Illuminate\Support\Str; @endphp
<h5 class="font-bold">TEKLİFLER</h5>
<div class="flex flex-row justify-between bg-gray-100 p-4 mt-4">
    <b class="text-left flex-1">Ad Soyad</b>
    <b class="text-left flex-1">Teklif</b>
    <b class="text-left flex-1">Tarih</b>
</div>
@foreach($bids as $bid)
    @php
        $names = explode(' ', $bid->user->name);
        $name = $names[0];
        $lastName = implode(' ', array_slice($names, 1));
    @endphp
    <div class="other-text flex border-b odd:border-b-none py-3 odd:bg-gray-200 even:bg-gray-100 px-4 flex-row justify-between">
        @if($hideName)
            <b class="text-left flex-1">{{Str::mask($name, '*', 1)}} {{Str::mask($lastName, '*', 1)}}</b>
        @else
            <b class="text-left flex-1">{{$bid->user->name}}</b>
        @endif
        <b class="text-left flex-1">{{Str::currency($bid->bid_amount)}}</b>
        <i class="text-left flex-1">{{Carbon::parse($bid->created_at)->diffForHumans()}}</i>
    </div>
@endforeach
<div class="my-4">
    {!! $bids->links() !!}
</div>
