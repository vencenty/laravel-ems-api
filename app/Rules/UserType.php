<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserType implements Rule
{
    const SUPPORT_USER_TYPE = [
        'student',
        'exam_site'
    ];

    /**
     * 必须在给定的数组元素中
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, static::SUPPORT_USER_TYPE);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '不支持的用户类型';
    }
}
