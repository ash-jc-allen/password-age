<?php

namespace AshAllenDesign\PasswordAge\Traits;

trait PasswordAge
{
    use PasswordAgeScopes, PasswordAgeNotifier;

    /**
     * This is invoked after the User model is instantiated.
     * We can use it for adding and editing properties on the User model.
     */
    public function initializePasswordAge()
    {
        // Add to the model's fillable fields.
        $this->fillable[] = 'password_expiry_notification_sent_at';
        $this->fillable[] = 'password_last_changed_at';
    }
}
