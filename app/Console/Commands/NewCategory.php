<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Console\Command;

class NewCategory extends Command
{
    private $categoryRepository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new category. | Example: category:create --name=foo';

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
        // Get All categories to show in proposals
        $categories = $this->categoryRepository->all();
        $proposals = [];
        $parent_id = null;

        foreach ($categories as $category) {
            $proposals[$category->id] = $category->name;
        }

        if(empty($proposals) == false){
            array_unshift($proposals, 'Null');

            // Choose parent category
            $parent_cat = $this->choice(
                'Choose parent category?',
                $proposals,
                '',
            );

            // Search for the id of category
            $parent_id = $parent_cat ? array_search($parent_cat, $proposals, true) : null;
        }
        
        $name = $this->option('name');
        $parent_id = $parent_id;

        if($parent_id){
            $parent = $this->categoryRepository->find($parent_id);

            if(!$parent){
                $this->error('Parent category not exists!');
                return 0;
            }
        }

        // create category instance
        $category = $this->categoryRepository->create([
            'name' => $name,
            'parent_id' => $parent_id,
        ]);

        if($category){
            $this->info('Category was created successful!');
            return 1;
        }

        $this->error('Something went wrong!');

        return 0;
    }
}
