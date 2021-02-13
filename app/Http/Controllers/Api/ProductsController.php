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

    /**
     * Get Or filter products
    * @return Collection
    */
    public function index()
    {
        // Get Category param from request
        $category_id = request()->input('category', null);
        
        // Get sort by param from request
        $sort_by = request()->input('sort_by', null);

        return $this->productRepository->search([
            'category' => $category_id,
            'sort_by' => $sort_by,
        ]);
    }

    /**
     * Create new product
    * @param $id
    * @return Response
    */
    public function create(Request $request)
    {
        $data = $request->all();

        $validation = $this->productRepository->validate($data);

        if(is_array($validation)){
            return response([
                'result' => 'error',
                'message' => 'The given data was invalid!',
                'errors' => $validation,
            ]);
        }

        
        $product = $this->productRepository->create($data);
        if($product){
            return response([
                'result' => 'success',
                'message' => 'Product was created successful!',
            ]);
        }

        return response([
            'result' => 'error',
            'message' => 'Sorry, something went wrong!',
        ]);

    }

    /**
     * Remove existing product
    * @param $id
    * @return Response
    */
    public function destroy($id)
    {
        if($this->productRepository->destroy($id)){
            return response([
                'result' => 'success',
                'deleted' => $id,
            ]);
        }

        return response([
            'result' => 'error',
        ]);
    }
}
