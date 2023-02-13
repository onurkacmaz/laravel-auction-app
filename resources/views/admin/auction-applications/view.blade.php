<x-admin-layout>
    <x-slot name="header" :url="route('admin.auction-applications.index')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $application->applicant_name }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="p-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 gap-4">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="grid-cols-2 grid gap-4">
                    <div class="mt-4 flex flex-col text-center">
                        <label for="applicant_name" class="block mb-2 text-sm font-medium text-gray-900">Başvuru Sahibi Adı ve Soyadı</label>
                        <input type="text" id="applicant_name" name="applicant_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$application->applicant_name}}" disabled>
                    </div>
                    <div class="mt-4 flex flex-col text-center">
                        <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900">Kurum Adı</label>
                        <input type="text" id="company_name" name="company_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$application->company_name}}" disabled>
                    </div>
                    <div class="mt-4 flex flex-col text-center">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Adres</label>
                        <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$application->address}}" disabled>
                    </div>
                    <div class="mt-4 flex flex-col text-center">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Telefon No</label>
                        <input type="tel" id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$application->phone}}" disabled>
                    </div>
                    <div class="mt-4 flex flex-col col-span-2 p-0 text-center">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Mail Adresi</label>
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{$application->email}}" disabled>
                    </div>
                    <div class="mt-4 flex flex-col p-0 text-center">
                        <label for="content_1" class="block mb-2 text-sm font-medium text-gray-900">1. Eser Detayı</label>
                        <textarea name="content_1" id="content_1" cols="30" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>{{$application->content_1}}</textarea>
                    </div>
                    <div class="mt-4 flex flex-col p-0 text-center">
                        <label for="content_2" class="block mb-2 text-sm font-medium text-gray-900">2. Eser Detayı</label>
                        <textarea name="content_2" id="content_2" cols="30" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>{{$application->content_2}}</textarea>
                    </div>
                    <div class="mt-4 flex flex-col col-span-2 p-0 text-center">
                        <label for="content_3" class="block mb-2 text-sm font-medium text-gray-900">3. Eser Detayı</label>
                        <textarea name="content_3" id="content_3" cols="30" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>{{$application->content_3}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
