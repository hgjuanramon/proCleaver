<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeSkill;
use App\Http\Component\Message_Response;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Class EmployeeController extends Controller  {

    public function index(){

        return "Hola desde el contolador";
    }
    public function countList(Request $request){

        $skills = Employee::where('first_name', 'LIKE',"%".$request['name_filter'].'%')->get();
        return response()->json($skills, 200);
    }

    public function getAllList(Request $request){

        $skills = Employee::where('first_name', 'LIKE',"%".$request['name_filter'].'%')
            ->limit($request['length'])
            ->offset($request["start"])->get();
        $this->getSkills($skills);

        return response()->json($skills, 200);
    }

    function getSkills(&$data){
        if(!empty($data)){
            foreach ($data as $key => $value){
                $skills = Employee::findOrFail($value->id)->skills()->get();
                $data[$key]['skills'] = $skills;
            }
        }

    }

    function getDataSkills(){
        $skills = Skill::all();
        return response()->json($skills, 200);
    }

    public function create(Request $request ){
        $skills = $request['skills'];
        unset($request['skills']);

        $res =Employee::create($request->all());

        if(!empty($skills)){
           $this->prepareSkills($skills,$res['id']);
        }

        return response()->json($res, 200);
    }

    public function update(Request $request,$id){

        $skills = $request['skills'];
        unset($request['skills']);

        $employee = Employee::findOrFail($id);

        if(empty($employee)){
            response()->json("Registro no valido", 404);
        }

        $employee->update($request->all());

        if(!empty($skills)){
            DB::table('employee_skills')->where('employee_id', $id)->delete();
           $this->prepareSkills($skills,$id);
        }
        return response()->json($employee, 200);
    }

    public function delete(Request $request,$id){
        $employee = Employee::findOrFail($id);

        if(empty($employee)){
            Message_Response::mensajeError("Registro no existe");
        }

        $employee->delete();
        return response()->json($employee, 200);

    }

    protected function prepareSkills($skills,$id){
        if(!empty($skills)){
            foreach ($skills as $value){
                $data =array(
                    'employee_id'=> $id,
                    "skill_id" => $value
                );
                DB::table('employee_skills')->insert($data);
            }
        }
    }


}