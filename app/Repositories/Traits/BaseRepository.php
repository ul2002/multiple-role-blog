<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use League\Fractal\Resource\Collection;

trait BaseRepository
{


    /**
     * @return array
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get all the records
     *
     * @param  Mixed $criteria
     * @return array Model
     */
    public function all($criteria = null )
    {
        return $this->model->get();
    }

    /**
     * Get number of the records
     *
     * @param  int $number
     * @param  string $sort
     * @param  string $sortColumn
     * @return Paginator
     */
    public function page($number = 10, $sort = 'desc', $sortColumn = 'ID')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }


    /**
     * @param $input
     * @return Model
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * @param $id
     * @param $input
     * @return Model
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);
        if(!$this->model){
           return null;
        }
        return  $this->save($this->model, $input);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function delete($id)
    {
        $this->model = $this->getById($id);
        if(!$this->model){
           return null;
        }
        $this->model->delete();

        return $this->model;
    }

    /**
     * @param Model $model
     * @param array $input
     * @return Model
     */
    protected function save($model, $input)
    {
        $model->fill($input);
        $model->save();
        return $model;
    }
}