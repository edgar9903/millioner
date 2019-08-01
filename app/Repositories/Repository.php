<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{

    /**
     * @var model
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Get all instances of model.
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     *  Create a new record in the database.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $d = [
            'usergroup' => 'test',
        ];
        return $this->model->create($data);
    }

    /**
     *  Find record in the database.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return  $this->model->find($id);
    }

    /**
     *  Find records in the database.
     *
     * @param int $id
     * @param int $limit
     * @param string $order_by
     * @return mixed
     */
    public function where(array $data,int $limit = null,string $order_by = null)
    {
        if(is_null($order_by)){

            if (is_null($limit)){

                return  $this->model->where($data)->get();
            }else{

                return  $this->model->where($data)->limit($limit);
            }
        }else{
            if (is_null($limit)){

                return  $this->model->where($data)->orderBy($order_by,'desc')->get();
            }else{

                return  $this->model->where($data)->orderBy($order_by,'desc')->limit($limit)->get();
            }

        }
    }

    /**
     * Update record in the database.
     *
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id)
    {
        $record =  $this->model->find($id);
        return $record->update($data);
    }

    /**
     * Remove record from the database
     *
     * @param $id
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}