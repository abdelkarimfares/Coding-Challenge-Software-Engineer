<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Models\Product_category;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param Product $model
    */
   public function __construct(Product $model)
   {
       parent::__construct($model);
   }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();    
    }
    
    /**
    * @return mixed or bool
    */
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|string',
            'image' => 'nullable|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if($validator->fails()){
            return $validator->errors()->toArray();
        }

        return true;    
    }

    /**
    * @param array $attributes
    *
    * @return Product or false
    */
    public function create(array $attributes): ?Product
    {
        $categories = [];

        if(isset($attributes['categories'])){
            
            $categories = $attributes['categories'];
            
            unset($attributes['categories']);

        }

        try {

            DB::beginTransaction();
            $product = $this->model->create($attributes);
            
            foreach ($categories as $cat_id) {

                Product_category::create([
                    'category_id' => $cat_id,
                    'product_id' => $product->id,
                ]);
    
            }

            DB::commit();
            return $product;
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }

        
    }

    /**
    * @param $filter
    * @return Collection
    */
    public function search(array $filter): Collection
    {
        $query = null;

        if(isset($filter['sort_by']) && $filter['sort_by']){

            $query = Product::orderBy($filter['sort_by']);
        }
        else{

            $query = Product::orderBy('id');

        }

        if(isset($filter['category']) && $filter['category']){

            $query = Product::join('product_categories', 'product_categories.product_id', '=', 'products.id')
                            ->where('product_categories.category_id', $filter['category'])
                            ->select('products.*');
        }


        return $query->with('categories')->get();

    }
   
}