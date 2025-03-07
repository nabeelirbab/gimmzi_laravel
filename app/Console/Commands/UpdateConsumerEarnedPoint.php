<?php

namespace App\Console\Commands;

use App\Models\ConsumerLoyaltyReward;
use App\Models\ConsumerLoyaltyRewardRedemption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateConsumerEarnedPoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:earnedpoint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $consumers = User::role('CONSUMER')->where('active', 1)->get();

        if ($consumers->isNotEmpty()) {
            foreach ($consumers as $user) {
                $user->point = 80; 
                $user->save();
            }
            Log::info('Gimmzi Badges refilled to 80 points for all active consumers.');
        } else {
            Log::info('No active consumers found for badge refill.');
        }

        $this->info('Gimmzi Badges refill process completed.');
    }
}
