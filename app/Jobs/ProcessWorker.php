<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\SubscriptionWorker;

class ProcessWorker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SubscriptionWorker;


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->subscriptionUpdate();
    }
}
