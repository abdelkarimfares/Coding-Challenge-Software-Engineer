<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        // Get Category params from request
        $category_id = request()->input('category', null);
        
        // Get order by params from request
        $sort_by = request()->input('sort_by', null);

        return $this->productRepository->search([
            'category' => $category_id,
            'sort_by' => $sort_by,
        ]);
    }
}
