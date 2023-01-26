@php use Illuminate\Support\Str; @endphp
@if($notifications->count() > 0)
    @foreach($notifications as $notification)
        <a href="{{$notification->data['url'] ?? '#'}}"
           data-id="{{$notification->id}}"
           class="notification-item flex flex-row bg-gray-100 hover:bg-gray-200 transition-all rounded-2xl p-4 mt-4 {{!$notification->read() ? 'bg-gray-300' : null}}">
            <div class="justify-center items-center flex flex-[0.2]">
                <img width="50" class="object-contain rounded-full bg-gray-100"
                     src="data:image/png;base64, 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">
            </div>
            <div class="ml-4 flex-1">
                <div>
                    <b>{{$notification->data['title'] ?? null}}</b>
                </div>
                <div class="mt-2 font-semibold">{{Str::limit($notification->data['message'] ?? null, 90)}}</div>
            </div>
        </a>
    @endforeach
@else
    <div class="mt-20 text-center font-bold text-xl text-gray-500">Henüz bildirim yok.</div>
@endif
