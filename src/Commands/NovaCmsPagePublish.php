<?php

namespace Addgod\NovaCms\Commands;

use Addgod\NovaCms\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class NovaCmsPagePublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:page:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if any unpublished pages, needs to published.';

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
     * @return mixed
     */
    public function handle()
    {
        $pages = Page::where('status', Page::PUBLISHED)->whereDate('scheduled_at', '>=', Carbon::now());
        $pages->update(['status' => PAGE::LIVE]);
    }
}
