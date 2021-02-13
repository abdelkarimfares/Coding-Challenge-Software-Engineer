<?php

namespace App\Console\Commands;

use App\Repository\CategoryRepositoryInterface;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    private $categoryRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = $this->categoryRepository->all();
        $proposals = [];
        $parent_id = null;

        foreach ($categories as $category) {
            $proposals[$category->id] = $category->name;
        }

        if(empty($proposals) == false){

            // Choose category to delete
            $deleted_cat = $this->choice(
                'Choose category to delete?',
                $proposals,
                '',
            );

            // Search for the id of category
            $parent_id = $deleted_cat ? array_search($deleted_cat, $proposals, true) : null;

            // delete category
            if($parent_id && $this->categoryRepository->destroy($parent_id)){
                $this->info('Category was deleted successful!');
                return 1;
            }else{
                $this->info('The given data was invalid!');
            }

        }
        else{
            $this->info('There\'s no category to delete!');
        }
        return 0;
    }
}
