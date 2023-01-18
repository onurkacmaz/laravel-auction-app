@php use Carbon\Carbon; @endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('messages.profile_information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("messages.profile_information_sub_title") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('messages.name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                          required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="tc_identification_number" :value="__('messages.tc_identification_number')"/>
            <x-text-input disabled="{{!empty($user->tc_identification_number)}}" id="tc_identification_number"
                          name="tc_identification_number" type="text" class="mt-1 block w-full disabled:opacity-50"
                          :value="old('tc_identification_number', $user->tc_identification_number)" autofocus
                          autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('tc_identification_number')"/>
        </div>

        <div>
            <x-input-label for="birth_date" :value="__('messages.birth_date')"/>
            <x-text-input id="birth_date" class="block mt-1 w-full" type="date"
                          name="birth_date"
                          :value="old('birth_date', $user->birth_date)" required/>
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('messages.email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="email"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('messages.your_email_address_is_unverified') }}

                        <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('messages.click_resend_verification_email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('messages.verification_email_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('messages.saved') }}</p>
            @endif
        </div>
    </form>
</section>
