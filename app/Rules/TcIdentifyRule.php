<?php

namespace App\Rules;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use SoapClient;

class TcIdentifyRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
        try {
            $names = explode(' ', $this->name);
            $result = $client->TCKimlikNoDogrula([
                'TCKimlikNo' => $this->tc_identification_number,
                'Ad' => $names[0],
                'Soyad' => implode(" ", array_slice($names, 1)),
                'DogumYili' => Carbon::parse($this->birth_date)->format('Y')
            ]);

            return $result->TCKimlikNoDogrulaResult;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'TC Kimlik Numaranız doğrulanamadı. İsim, Doğum tarihi ve TC Kimlik Numaranızı kontrol ediniz.';
    }
}
