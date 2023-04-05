<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryParent implements ValidationRule
{
    private $category;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        return $this->category->validParent($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return trans('validation.custom.parent_id.invalid');
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }


}
