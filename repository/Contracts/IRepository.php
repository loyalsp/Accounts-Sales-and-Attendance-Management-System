<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 7/5/2017
 * Time: 3:15 PM
 */

namespace App\Repositories\Contracts;


use Illuminate\Support\Facades\DB;

interface IRepository
{
    /*
     * This interface is intended to serve all database access operation
     * */
    public function getTable($table);
    public function createRecord(array $attributes);
    public function updateRecord($id, array $attributes);
    public function getAllRecords();
    public function getRecordById($id);
    public function getRecordByAttribute($column, $value);
    public function deleteRecord($id,$table);
}