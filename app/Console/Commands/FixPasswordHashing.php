<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FixPasswordHashing extends Command
{
    protected $signature = 'user:fix-password {email?} {--all : Fix all users with plain text passwords} {--password= : New password to set}';
    protected $description = 'Fix password hashing for one or all users';

    public function handle()
    {
        if ($this->option('all')) {
            return $this->fixAllPasswords();
        }

        $email = $this->argument('email');
        if (!$email) {
            $this->error('Please provide an email or use --all flag');
            return 1;
        }

        return $this->fixSingleUser($email);
    }

    protected function fixSingleUser($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        $password = $this->option('password') ?: $user->password;
        
        if ($this->isAlreadyHashed($password)) {
            $this->info("Password for user {$user->email} is already hashed.");
            return 0;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info("Password successfully updated for user: {$user->email}");
        return 0;
    }

    protected function fixAllPasswords()
    {
        $users = User::all();
        $updated = 0;

        $this->info("Checking and fixing passwords for all users...");
        
        foreach ($users as $user) {
            // Force update password regardless of current hashing
            $currentPassword = $user->password;
            
            // If password is not hashed or is not a valid Bcrypt hash, rehash it
            if (!$this->isValidBcryptHash($currentPassword)) {
                $newPassword = $this->option('password') ?: $currentPassword;
                $user->password = Hash::make($newPassword);
                $user->save();
                $this->line("Updated password for: {$user->email}");
                $updated++;
            }
        }

        $this->info("\nPassword update complete!");
        $this->info("Total users checked: " . $users->count());
        $this->info("Passwords updated: $updated");
        
        return 0;
    }

    protected function isValidBcryptHash($value)
    {
        if (empty($value) || !is_string($value)) {
            return false;
        }
        
        $info = password_get_info($value);
        return $info['algo'] === PASSWORD_BCRYPT && 
               preg_match('/^\$2[ayb]\$.{56}$/', $value);
    }
}
