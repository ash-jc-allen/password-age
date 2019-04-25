# Password Age
A simple package for automating a password expiration policy for users.

## Introduction
Password Age is a simple Laravel package that piggy backs off the password reset functionality already included in the default Laravel installation.

By using this package, you can implement a password expiration policy on your users by notifying them when their password has been used for too long.

## Installation
To install the package using Composer, use the following command:

``` composer require ashallendesign/password-age ```

Once it is installed, you will need to add the **PasswordAge** trait to the User model (assuming that you are enforcing the policy on the User model).
You must also make sure that the User model also implements the **ChecksPasswordAge** contract.

After this, run ``` php artisan migrate ``` to add the package's fields to the 'users' table.

Note: The package makes use of notifications for contacting the user, so please ensure that the **Notifiable** trait is added to the User model.

Example of how the User model should look after adding the required traits and contract:

```
<?php

namespace App;

use AshAllenDesign\PasswordAge\Contracts\ChecksPasswordAge;
use AshAllenDesign\PasswordAge\Traits\PasswordAge;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements ChecksPasswordAge
{
    use Notifiable, PasswordAge;
    
    // The rest of your model...
}
```

If you wish to fully automate the password expiration process, you can add the following command to the Laravel scheduler: ``` passwords:expire ```.

## Configuration
If you wish to make changes to the config file, you can publish the config files by using:

``` php artisan vendor:publish --provider=AshAllenDesign\PasswordAge\PasswordAgeServiceProvider ```

## Usage
### Command
Run the following command to manually find all of the users with expired passwords and notify them:

``` php artisan passwords:expire ```

### User functions
To check if a user has an expired password, you can use the following function:

``` ->hasExpiredPassword() ```.

If the password is older than the expiration time (for example, the user expiration time is 30 days, but the password is 50 days old), the method will return true.
Otherwise, it will return false.

#### Examples

```
// A user with an expired password
$user = User::first(); 
$expired = $user->hasExpiredPassword();

// Expired = true.
```

```
// A user with an non-expired password
$user = User::first(); 
$expired = $user->hasExpiredPassword();

// Expired = false.
```

### Query Scopes
When building a query for fetching User's, you can use the following scopes:
``` onlyExpiredPasswords() ``` and ``` onlyNonExpiredPasswords() ```. These can be useful if you are wanting to return a list of users
to a view that have expired passwords.

#### Examples
```
// Fetch all users with expired passwords.
$users = User::onlyExpiredPasswords()->get();

// Users = all users that have an expired password.
```

```
// Fetch all users with non-expired passwords.
$users = User::onlyNonExpiredPasswords()->get();

// Users = all users that have a non-expired password.
```

## Known Issues & Future Work
 * The config file should have options so that the notifications can be sent via SMS and slack.
 * The package currently listens on the PasswordReset event fired by Laravel. This isn't great though because the password can be updated without this event being fired.