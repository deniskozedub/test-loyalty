<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\LoyaltyAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AccountActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private LoyaltyAccount $loyaltyAccount
    ) {}

    public function handle()
    {
        if ($this->loyaltyAccount->active){
            //send mail on active account
        }else{
            //send mail on inactive account
        }
    }
}
