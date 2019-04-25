<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Password Expiry Age
    |--------------------------------------------------------------------------
    |
    | The amount of time that a password should be allowed to be used
    | before an expiry notification is sent to them to prompt the
    | user to update it.
    |
    | The date here is parsed using Carbon, so you have a reasonable
    | amount of flexibility when defining the time.
    |
    */
    'expiry-age' => '3 months',

    /*
    |--------------------------------------------------------------------------
    | Interval Between Sending Notifications
    |--------------------------------------------------------------------------
    |
    | This defines the amount of time that should be taken in between sending
    | notifications to the user. For example, if the interval is set to
    | 5 days and a user has already been sent a notification, we
    | will not send them another expiry notification for at
    | least another 5 days.
    |
    */
    'notification-interval' => '5 days'
];
