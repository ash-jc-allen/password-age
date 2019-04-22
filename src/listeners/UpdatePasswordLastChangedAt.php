<?php

namespace AshAllenDesign\PasswordAge\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Carbon\Carbon;

class UpdatePasswordLastChangedAt
{
    /**
     * Handle the event.
     *
     * @param PasswordReset $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $event->user->update(['password_last_changed_at' => Carbon::now()]);
    }
}
