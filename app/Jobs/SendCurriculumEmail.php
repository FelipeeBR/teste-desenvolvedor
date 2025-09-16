<?php

namespace App\Jobs;

use App\Mail\CurriculumMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCurriculumEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailData;

    public function __construct(array $emailData)
    {
        $this->emailData = $emailData;
    }

    public function handle(): void
    {
        Mail::to($this->emailData['email'])
            ->send(new CurriculumMail(
                $this->emailData['file_real_path'], 
                $this->emailData
            ));
    }
}