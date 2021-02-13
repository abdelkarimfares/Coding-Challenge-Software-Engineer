<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
    * @return Collection
    */
    public function all(): Collection;

    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model;

    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model;

    /**
    * @param $id
    * @return bool
    */
    public function destroy($id): bool;
}