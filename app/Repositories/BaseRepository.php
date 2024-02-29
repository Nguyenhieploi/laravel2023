<?php
//  CLASS CHA CHO CÁC CON KẾ THỪA
namespace App\Repositories;

use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
/**
 * Class ProvinceService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    // Thưc hiện các thao tác với CSDL
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function pagination(
        array $columns = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = null,
        array $relations = []
    ) {
        $query = $this->model->select($columns)->where(function ($query) use ($condition) {
            if (!empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%' . $condition['keyword'] . '%');
            }
            if (isset($condition['publish']) && $condition['publish'] != -1) {
                $query->where('publish', '=', $condition['publish']);
            }
        });
    
        if (!empty($relations)) {
            foreach ($relations as $relation) {
                $query->withCount($relation);
            }
        }
    
        if (!empty($join)) {
            foreach ($join as $j) {
                // Ensure $j has the correct structure to be spread into the join method.
                $query->join(...$j);
            }
        }
    
        $path = isset($extend['path']) ? $extend['path'] : '';
        return $query->paginate($perPage)->withQueryString()->withPath(config('app.url') . $path);
    }
    
    public function all(){
        return $this->model->all();
    }

    public function create(array $payload =[]){
        $model =  $this->model->create($payload);
        return $model->fresh();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = [])
    {
        return $this->model->select($column)->with($relation)->findOrFail( $modelId);
    }

    public function update(int $id = 0, array $payload = []){
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function updateByWhereIn(string $whereInField = '', array $whereIn =  [], array $payload = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
    // Xóa mềm
    public function delete(int $id= 0 ){
        return $this->findById($id)->delete();
    }

    // Xóa cứng
    public function forceDelete(int $id = 0){
        return $this->findById($id)->forceDelete();
    }
}
