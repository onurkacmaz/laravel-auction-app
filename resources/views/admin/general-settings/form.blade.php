<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.general-settings') }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="p-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 gap-4">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ route("admin.general-settings.save") }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 columns-2">
                        @foreach($settings as $setting)
                            <div>
                                <label for="{{$setting->key}}" class="text-base font-bold text-gray-700">
                                    {{$setting->name}}
                                </label>
                                @if($setting->key === "footer" || $setting->key === "auction_application_description")
                                    <pre class="mt-4"><code contenteditable="true"
                                                            onkeyup="$('.' + '{{$setting->key}}').val(this.innerText);"
                                                            class="h-96 text-xs border rounded-lg">{{$setting->value}}</code></pre>
                                    <input type="hidden" name="{{$setting->key}}" class="{{$setting->key}}" value="{{$setting->value}}">
                                @elseif($setting->key === "menu_banner")
                                    <input type="file" name="{{$setting->key}}" id="{{$setting->key}}"
                                           value="{{$setting->value}}"
                                           data-file-metadata-images="{{json_encode([$setting->value])}}"
                                           class="filepond" data-max-files="1">
                                @elseif($setting->key === "homepage_slider")
                                    <input type="file" name="{{$setting->key}}[]" id="{{$setting->key}}"
                                           value="{{$setting->value}}"
                                           data-file-metadata-images="{{$setting->value}}"
                                           class="filepond" multiple>
                                @else
                                    <input type="text" name="{{$setting->key}}" id="{{$setting->key}}"
                                           value="{{$setting->value}}"
                                           class="mt-4 w-full border rounded-lg px-4 py-2 text-xs">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-4 text-right">
                        <button type="submit"
                                class="bg-indigo-600 text-white font-bold py-2 px-4 rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
