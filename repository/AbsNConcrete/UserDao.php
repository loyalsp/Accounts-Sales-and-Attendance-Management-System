<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/2/17
 * Time: 7:41 PM
 */

namespace App\Repositories;
use App\Repositories\AbsNConcrete\CommonBehaviors;

class UserDao extends CommonBehaviors
{
    public function model()
    {
     return 'App\User';
    }
    
}