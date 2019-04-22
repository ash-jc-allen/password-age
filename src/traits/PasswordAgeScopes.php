<?php

namespace AshAllenDesign\PasswordAge\Traits;

use Carbon\Carbon;

trait PasswordAgeScopes
{
    public function hasExpiredPassword()
    {
        return $this->password_last_changed_at <= Carbon::now()->sub(config('password-age.expiry-age'));
    }

    public static function scopeOnlyExpiredPasswords($query)
    {
        return $query->where('password_last_changed_at', '<=', Carbon::now()->sub(config('password-age.expiry-age')));
    }

    public static function scopeOnlyNonExpiredPasswords($query)
    {
        return $query->where('password_last_changed_at', '>=', Carbon::now()->sub(config('password-age.expiry-age')));
    }
}
