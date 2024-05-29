<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
class CampaingStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camp:campaign-status-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Campaign status update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDateTime =Carbon::now()->format('Asia/Dhaka');
        $expiredCampaigns = Campaign::where('status','Published')->where('end_date', '<',$currentDateTime)->get();
        foreach ($expiredCampaigns as $campaign) {
           $endCampDate =  Carbon::parse( $campaign->end_date);
          $expiredTime =  $endCampDate->diffInDays( $currentDateTime);
          if($expiredTime!=null){
            $campaign->status = 'Draft';
            $campaign->save();
           
          }
          Log::info($expiredTime);
        }
    }
}
