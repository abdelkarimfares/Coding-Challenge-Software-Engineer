<?php

namespace App\Console\Commands;

use App\Repository\ProductRepositoryInterface;
use Illuminate\Console\Command;

class NewProduct extends Command
{
    private $productRepository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {--name=} {--description=} {--price=} {--image=} {--category=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new product | example: product:create --name=product name --description=product description --price=product price --image= image path [--category=category id]*';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [
            'name' => $this->option('name'),
            'description' => $this->option('description'),
            'price' => $this->option('price'),
            'image' => $this->option('image'),
            'categories' => $this->option('category'),
        ];

        $validation = $this->productRepository->validate($data);
        if(is_array($validation)){
            $validation = array_values($validation);
            $this->error($validation[0][0]);
            
        }else{

            $product = $this->productRepository->create($data);
            
            if($product){

                $this->info('Product was created successful!');
                return 1;
            }
            else{
                $this->error('Sorry, something went wrong!');
            }

        }

        return 0;
    }
}
