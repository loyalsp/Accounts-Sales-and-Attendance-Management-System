<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 8/8/2017
 * Time: 11:54 PM
 */

namespace App\Repositories;


use App\Repositories\AbsNConcrete\CommonBehaviors;

class StoreDao extends CommonBehaviors
{
        public function model()
        {
            return 'App\Store';
        }
}