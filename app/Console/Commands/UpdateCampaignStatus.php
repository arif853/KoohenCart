<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCampaignStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:campaign-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Campaign status update on expired.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDateTime = Carbon::now('Asia/Dhaka');
        Log::info('Running UpdateCampaignStatus command at ' . $currentDateTime);
        $expiredCampaigns = Campaign::where('status', 'Published')
                                    ->where('end_date', '<', $currentDateTime)
                                    ->get();

        foreach ($expiredCampaigns as $campaign) {
            if($campaign)
            {
                $campaign->status = 'Draft';
                $campaign->save();
                Log::info('Campaign statuses updated successfully.');
            }
        }
        Log::info('Campaign status update command run successfully!');
    }
}
