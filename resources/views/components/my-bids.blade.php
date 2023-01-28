@php use Carbon\Carbon;use Illuminate\Support\Str; @endphp
<table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
    <tr>
        <th scope="col" class="px-6 py-3">
            ESER
        </th>
        <th scope="col" class="px-6 py-3">
            PEY DEĞERİ
        </th>
        <th scope="col" class="px-6 py-3">
            PEY TARİHİ
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($bids as $bid)
        <tr class="bg-white border-b">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                <a target="_blank" class="hover:underline"
                   href="{{route('auctions.artworks.show', ['id' => $bid->artwork->id])}}">{{$bid->artwork->title}}</a>
            </th>
            <td class="px-6 py-4">
                {{Str::currency($bid->bid_amount)}}
            </td>
            <td class="px-6 py-4">
                {{Carbon::parse($bid->created_at)->diffForHumans()}} <small>({{Carbon::parse($bid->created_at)->format('d.m.Y H:i')}})</small>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="text-center mt-4">
    {{ $bids->links() }}
</div>
