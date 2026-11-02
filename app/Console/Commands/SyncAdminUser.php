<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

#[Signature('app:sync-admin-user')]
#[Description('Create or update the configured invitation administrator')]
class SyncAdminUser extends Command
{
    public function handle(): int
    {
        $email = (string) config('admin.email');
        $password = config('admin.password');

        if (Validator::make(['email' => $email], ['email' => ['required', 'email', 'max:255']])->fails()) {
            $this->error('Set a valid ADMIN_EMAIL in the environment.');

            return self::FAILURE;
        }

        if (! is_string($password) || mb_strlen($password) < 12) {
            $this->error('Set an ADMIN_PASSWORD with at least 12 characters in the ignored .env file.');

            return self::FAILURE;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => config('admin.name'),
                'password' => $password,
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );

        $this->info("Administrator [{$email}] is ready.");

        return self::SUCCESS;
    }
}
