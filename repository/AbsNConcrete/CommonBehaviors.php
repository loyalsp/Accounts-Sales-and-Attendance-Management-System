<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 7/7/2017
 * Time: 12:08 PM
 */

namespace App\Repositories\AbsNConcrete;

use App\Repositories\Contracts\IRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;
use DateTime;

/**
 * Class CommonBehaviors
 * @package App\Repositories\AbsConcrete
 */
abstract class CommonBehaviors implements IRepository
{

    /**
     * @var App
     */
    private $app;
    /**
     * @var
     */
    protected $model;

    /**
     * @return mixed
     */
    abstract function model();

    /**
     * CommonBehaviors constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @param $tableName
     * @return mixed
     */
    public function getTable($tableName)
    {
        return DB::table($tableName);
    }

    /**
     * @return mixed
     */
    public function getAllRecords()
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRecordById($id)
    {
        return $this->model->find($id);

    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function getRecordByAttribute($column, $value)
    {
        //parameter 1 is must be column name and the second parameter must be value of column
        return $this->model->where($column, $value)->first();
        //OR static context "return User::where($column,$att)->first();"
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function deleteRecordByAtt($column, $value)
    {
        //return true if success
        return $this->model->getRecordByAttribute($column, $value)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id, $table)
    {
        return $this->getRecordById($id)->delete();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createRecord(array $attributes)
    {
        $created = $this->model->create($attributes);
        return $created;
    }


    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateRecord($id, array $attributes)
    {
        $this->model = $this->getRecordById($id);
        return $this->model->update($attributes);
    }

    /**
     * @return mixed
     */
    protected function getResultByToday()
    {
        return $this->model
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->whereDay('created_at', date('d'));
    }

    /**
     * @return mixed
     */
    protected function getResultByCurrentMonth()
    {
        return $this->model
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'));
    }

    /**
     * @param $column
     * @return mixed
     */
    public function getTodayMaxValues($column)
    {
        return $this->getResultByToday()->orderBy($column, 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model->newQuery();
    }
}