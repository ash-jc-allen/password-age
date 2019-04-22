<?php

namespace AshAllenDesign\PasswordAge\Commands;

use AshAllenDesign\PasswordAge\Contracts\ChecksPasswordAge;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\User;

class CheckForExpiredPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passwords:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks all users passwords and sends an email to any users with expired passwords.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if((new User()) instanceof ChecksPasswordAge) {
            $this->sendResetNotifications($this->fetchExpiredUsers());
        }
    }

    /**
     * Fetch any users that have an expired password and that have
     * not had a password expiry notification sent to them
     * within the time period defined in the config
     * as 'notification-interval'.
     *
     * @return mixed
     */
    private function fetchExpiredUsers()
    {
        return User::onlyExpiredPasswords()
            ->where('password_expiry_notification_sent_at', '<=', Carbon::now()->sub(config('password-age.notification-interval')))
            ->get();
    }

    /**
     * For each of the users fetched, create a new password reset token
     * and then send them a password expired notification,
     *
     * @param $users
     */
    private function sendResetNotifications($users)
    {
        foreach($users as $user) {
            $token = app('auth.password.broker')->createToken($user);
            $user->sendPasswordExpiredNotification($token);
        }
    }
}
