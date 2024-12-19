<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashPasswords extends Command
{
    protected $signature = 'users:hash-passwords';
    protected $description = 'Hash plain text passwords in the database';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!Hash::needsRehash($user->password)) {
                continue;
            }

            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('Passwords hashed successfully!');
    }
}