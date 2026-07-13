<?php

namespace App\Console\Commands;

use App\Models\Election;
use Illuminate\Console\Command;

class SyncElectionStatuses extends Command
{
    protected $signature = 'elections:sync-statuses';
    protected $description = 'Update election statuses based on start and end dates';

    public function handle(): void
    {
        Election::all()->each(function (Election $election) {
            $newStatus = $election->computeStatus();
            if ($election->status !== $newStatus) {
                $election->status = $newStatus;
                $election->saveQuietly();
            }
        });

        $this->info('Election statuses synced.');
    }
}