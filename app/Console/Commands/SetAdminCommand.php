<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-admin {email} {--revoke : Revoke admin privileges instead}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant or revoke admin privileges for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $revoke = $this->option('revoke');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ User with email '{$email}' not found!");
            return 1;
        }

        if ($revoke) {
            $user->is_admin = false;
            $user->save();
            $this->info("✅ Admin privileges revoked for '{$email}'");
        } else {
            $user->is_admin = true;
            $user->save();
            $this->info("✅ User '{$email}' is now an admin!");
        }

        $this->newLine();
        $this->table(
            ['Name', 'Email', 'Is Admin', 'Verified'],
            [[
                $user->name,
                $user->email,
                $user->is_admin ? '✓ Yes' : '✗ No',
                $user->email_verified_at ? '✓ Yes' : '✗ No'
            ]]
        );

        return 0;
    }
}
