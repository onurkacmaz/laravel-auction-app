<form method="post" action="{{ route("send-application") }}">
    @csrf
    <div class="mt-20">
        <h3 class="text-center">Müzayede Başvuru Formu</h3>
        <p class="mt-5 text-center text-gray-400">{!! $generalSettings['auction_application_description'] ?? null !!}</p>
        <div class="mt-20 mx-auto w-full lg:w-1/2 grid-cols-2 grid gap-4">
            <div class="mt-4 flex flex-col text-center">
                <label for="applicant_name" class="font-bold">Başvuru Sahibi Adı ve Soyadı</label>
                <input type="text" id="applicant_name" name="applicant_name" class="border p-4 bg-gray-50 text-lg font-bold" required>
            </div>
            <div class="mt-4 flex flex-col text-center">
                <label for="company_name" class="font-bold">Kurum Adı</label>
                <input type="text" id="company_name" name="company_name" class="border p-4 bg-gray-50 text-lg font-bold" required>
            </div>
            <div class="mt-4 flex flex-col text-center">
                <label for="address" class="font-bold">Adres</label>
                <input type="text" id="address" name="address" class="border p-4 bg-gray-50 text-lg font-bold" required>
            </div>
            <div class="mt-4 flex flex-col text-center">
                <label for="phone" class="font-bold">Telefon No</label>
                <input type="tel" id="phone" name="phone" class="border p-4 bg-gray-50 text-lg font-bold" required>
            </div>
            <div class="mt-4 flex flex-col col-span-2 p-0 text-center">
                <label for="email" class="font-bold">Mail Adresi</label>
                <input type="email" id="email" name="email" class="border p-4 bg-gray-50 text-lg font-bold" required>
            </div>
            <div class="mt-4 flex flex-col p-0 text-center">
                <label for="content_1" class="font-bold">1. Eser Detayı</label>
                <textarea name="content_1" id="content_1" cols="30" rows="10" class="border p-4 bg-gray-50 text-lg font-bold" required></textarea>
            </div>
            <div class="mt-4 flex flex-col p-0 text-center">
                <label for="content_2" class="font-bold">2. Eser Detayı</label>
                <textarea name="content_2" id="content_2" cols="30" rows="10" class="border p-4 bg-gray-50 text-lg font-bold" required></textarea>
            </div>
            <div class="mt-4 flex flex-col col-span-2 p-0 text-center">
                <label for="content_3" class="font-bold">3. Eser Detayı</label>
                <textarea name="content_3" id="content_3" cols="30" rows="10" class="border p-4 bg-gray-50 text-lg font-bold" required></textarea>
            </div>
            <div class="mt-4 flex flex-col col-span-2 p-0 text-center">
                <button type="submit" class="btn bg-red-700 text-white">
                    <span class="font-bold">Gönder</span>
                </button>
            </div>
        </div>
    </div>
</form>
