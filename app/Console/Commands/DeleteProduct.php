<?php

namespace App\Console\Commands;

use App\Repository\ProductRepositoryInterface;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     *  The product repository api
     *
     * @var App\Repository\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete existing product | example: product:delete --id=2';

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
        $product_id = $this->option('id');

        if($this->productRepository->destroy($product_id)){
            $this->info('Product was deleted successful!');
            return 1;
        }

        $this->error('Product not exists!');

        return 0;
    }
}
