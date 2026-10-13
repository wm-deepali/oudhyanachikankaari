<?php

namespace App\Console\Commands;

use App\Services\MetaFeedService;
use Illuminate\Console\Command;

class GenerateMetaFeed extends Command
{
    protected $signature = 'meta:generate-feed';
    protected $description = 'Generate the Meta Commerce product feed (storage/app/meta-feed.xml)';

    public function handle(MetaFeedService $feed): int
    {
        $count = $feed->generate(storage_path('app/meta-feed.xml'));

        $this->info("Meta feed generated: {$count} products.");

        return self::SUCCESS;
    }
}