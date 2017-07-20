<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmptyTrashCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trash:empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete trashed items in all primary models which use soft delition';

    const SOFT_DELETABLE = [
        \App\Models\Specialty\Specialty::class,
        \App\Models\Institution\Institution::class,
        \App\Models\Profession\Profession::class,
        \App\Models\Article\Article::class,
    ];

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
        foreach (self::SOFT_DELETABLE as $class) {
            $class::onlyTrashed()->forceDelete();
        }

        $this->info("All trashed items have been deleted.");
    }
}
