@php use Illuminate\Support\Str; @endphp
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.auction_applications') }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-table>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-sm text-left p-4 bg-indigo-50">Başvuran Ad Soyad</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Kurum Adı</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Telefon No</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">E-Mail</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Düzenle</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr class="border-b">
                                <td class="text-sm text-left font-bold p-4">{{ $application->applicant_name }}</td>
                                <td class="text-sm text-left font-bold p-4">{{ $application->company_name }}</td>
                                <td class="text-sm text-left font-bold p-4">{{ $application->phone }}</td>
                                <td class="text-sm text-left font-bold p-4">{{ $application->email }}</td>
                                <td class="text-left font-bold p-4">
                                    <a href="{{ route('admin.auction-applications.view', ['id' => $application->id]) }}">
                                        <i class="fa fa-eye text-green-600"></i>
                                    </a>
                                </td>
                                <td class="text-left font-bold p-4">
                                    <a class="delete-record" href="{{ route('admin.auction-applications.destroy', ['id' => $application->id]) }}">
                                        <i class="fa fa-times text-red-600"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-table>
            </div>
            <div class="text-center">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
