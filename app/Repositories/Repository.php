<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    //Debe ser un array asociativo, con las siguientes keys field y ascending

    /**
     * @param  array $select
     * Debe ser un array con los nombres de columnas
     * @param  array $relations
     * Debe ser un array con los nombre asociativos relacionados
     * @param array $orderBy
     * Debe ser un array asociativos, las keys (field y ascending)
     * 
     * @return array
     *  
    */

    public function list(array $select = ['*'], array $relations = [], array $orderBy = [])
    {
        $query = $this->model;

        if(!empty($relations)) {
            $query = $this->relations($query, $relations);
        }

        if( !empty($orderBy) ){
            $orderBy = (object) $orderBy;
            $query = $query->orderBy($orderBy->field, $orderBy->ascending);
        }
        

        return $query->get($select)->toArray();
    }

    private function relations(Model $model, array $relations = []) : Model
    {
        $model->with($relations);

        return $model;
    }

    public function get(int $id) : Model
    {
        return $this->model->find($id);
    }

    public function getOrFail(int $id) : Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $dataCreate)
    {
        return $this->model->create($dataCreate);
    }

    public function save(Model $model)
    {
        $model->save();

        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();

        return $model;
    }



}