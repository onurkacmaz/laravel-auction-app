@if(count($errors))
    <div class="pt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex p-4 mb-4 text-sm text-red-700 border bg-red-100 rounded-lg" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Usps!</span>
            <div>
                <span class="font-medium">Bu gereksinimlerin karşılandığından emin olun:</span>
                <ul class="mt-1.5 ml-4 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(Session::has('success'))
    <div class="pt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 text-sm text-green-700 bg-green-100 border rounded-lg" role="alert">
            <i class="fa fa-check-circle"></i> {{Session::get('success')}}
        </div>
    </div>
@endif
