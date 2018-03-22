<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    //

    protected $table ="employee_skills";
    protected $primaryKey="id";
    protected $fillable = ['id','employe_id', 'skill_id'];

    public function employees()
    {
        return $this->hasOne('App\Employee','employee_id','id');
    }
}
