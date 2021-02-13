<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categoryRepository;
    
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all categories
    * @return Collection
    */
    public function index()
    {
        return $this->categoryRepository->all();
    }
}
