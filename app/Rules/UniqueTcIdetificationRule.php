<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UniqueTcIdetificationRule implements Rule
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
        $allHashedTcNumbers = User::query()->whereNotNull('tc_identification_number')->pluck('tc_identification_number')->toArray();

        foreach ($allHashedTcNumbers as $hashedTcNumber) {
            if (Hash::check($value, $hashedTcNumber)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Bu TC Kimlik Numarası sistemde kayıtlı.';
    }
}
