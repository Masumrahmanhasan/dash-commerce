<?php
declare(strict_types=1);
namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Sending welcome email');
        Mail::to($this->user)
            ->send(new WelcomeEmail($this->user));
    }
}
