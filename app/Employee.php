<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table ="employees";
    protected $primaryKey="id";
    protected $fillable = ['id','first_name', 'last_name','email','birth_date','employment','address'];

    public function skills(){

        return $this->hasMany('App\EmployeeSkill');
    }
}
