<?php

namespace App\Console\Commands;

use App\Mail\MembershipRegisterNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MembershipPaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membershippayment:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membership Payment Reminder Email';

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
     * @return int
     */
    public function handle()
    {
        $user = User::where('username', 'mchmdarvan')->first();

        Mail::to($user->email)
            ->send(new MembershipRegisterNotification([
                'email' => $user->email,
            ]));
    }
}
