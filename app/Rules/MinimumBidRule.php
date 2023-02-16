<?php

namespace App\Rules;

use App\Http\Services\ArtWorkService;
use App\Http\Services\SettingService;
use App\Models\ArtWork;
use App\Models\LimitSetting;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RuntimeException;

class MinimumBidRule implements Rule
{
    private ArtWork|Model|null $artWork;
    private float $min_bid_amount;
    private LimitSetting|Model|null $limitSetting;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->artWork = (new ArtWorkService())->getArtWorkById($id);
        $this->limitSetting = (new SettingService())->getSettings()->getCollection()->where('start_price', '<=', $this->artWork->end_price)->where('end_price', '>=', $this->artWork->end_price)->first();
        $this->min_bid_amount = $this->artWork->end_price + $this->limitSetting?->min_bid_amount ?? 0;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if ($attribute === "bid_amount" && $value >= $this->min_bid_amount) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return sprintf(":attribute %s değerinden büyük veya eşit olmalıdır.", Str::currency($this->min_bid_amount));
    }
}
