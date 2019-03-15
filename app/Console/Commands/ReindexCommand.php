<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Entities\Article;
use Elasticsearch\Client;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $name = "search:reindex";

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = "Indexes all articles to elasticsearch";

    private $search;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $search)
    {
        parent::__construct();
        $this->search = $search;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. Might take a while...');

        foreach (Article::cursor() as $model)
        {
            $this->search->index([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => $model->toSearchArray(),
            ]);

            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}
