<?php

namespace AshAllenDesign\PasswordAge\Traits;

use AshAllenDesign\PasswordAge\Notifications\PasswordExpiredNotification;
use Carbon\Carbon;

trait PasswordAgeNotifier
{
    public function sendPasswordExpiredNotification(string $token)
    {
        $this->notify(new PasswordExpiredNotification($token));
        $this->update(['password_expiry_notification_sent_at' => Carbon::now()]);
    }
}
