<?php
/**
 * Created by PhpStorm.
 * User: JuanRamon
 * Date: 20/03/2018
 * Time: 05:49 PM
 */

namespace App\Http\Controllers;
use App\Http\Component\Message_Response;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Component\ValidadorUtil;

class UseEmployeeController extends Controller {

    protected  $data= [];
    public function index(){
        $this->data["skills"] = $this->getSkills();
        return  \View::make("employee/employee", $this->data);
    }

    public function getAllList(Request $request){

        $draw = $request['draw'];
        $filtros = $request['filtros'];
        $filtros["start"] = $request['start'];
        $filtros["length"] = $request['length'];
        $client = new Client();

        $count = $client->request("POST","http://codh.heladoobscuro.com.mx/public/api/employee-count",["form_params"=>$filtros]);
        $res = $client->request("POST","http://codh.heladoobscuro.com.mx/public/api/employee",["form_params"=>$filtros]);
        $data = json_decode($res->getBody());
        $total = count(json_decode($count->getBody()));

        if ($total == 0) {
            Message_Response::datosJSON ( $draw, $total );
        }

      Message_Response::datosJSON ( $draw, $total, $data );
    }

    public function getSkills(){

        $client = new Client();
        $res = $client->request("GET","http://codh.heladoobscuro.com.mx/public/api/skills");
        return json_decode($res->getBody());
    }

    protected function _form_validation($post){

        $validadorUtil = new ValidadorUtil( $post );
        $validadorUtil->validarTexto ( "first_name", true, 1, 255 );
        $validadorUtil->validarTexto ( "last_name", true, 1, 255 );
        $validadorUtil->validarCorreoElectronico("email", true, 1, 255 );
        $validadorUtil->validarTexto( "birth_date", true, 1,100);
        $validadorUtil->validarTexto ( "employment", true, 1, 255 );
        $validadorUtil->validarTextoN("skills", true, 1, 500 );

        $validadorUtil->agregarEtiquetas ( array (
            'first_name' => 'El campo nombre',
            'last_name' => 'El campo apellidos',
            'email' => 'El campo email',
            'birth_date' => 'El campo fecha nacimiento',
            'employment' => 'El campo puesto',
            'address' => 'El campo dirección',
            'skills' => 'El campo Habilidades',
        ) );

        if (! $validadorUtil->validate ()) {
            Message_Response::mensajesErrores ( $validadorUtil->getErrors () );
        }
    }

    public function save(Request $request){


        $client = new Client();
        $data=[];
        $data['first_name']=$request['first_name'];
        $data['last_name']=$request['last_name'];
        $data['email']=$request['email'];
        $data['birth_date']=$request['birth_date'];
        $data['employment']=$request['employment'];
        $data['address']=$request['address'];
        $data['skills']= ($request['skills'])?implode(",", $request['skills']): null;
        $id = $request['id'];
        $this->_form_validation($data);

        $data["skills"]= $request["skills"];

        if($id > 0 ){
            $res = $client->request("POST","http://codh.heladoobscuro.com.mx/public/api/employee-update/". $id, ['form_params' => $data]);
            $response = json_decode($res->getBody());
            Message_Response::mensaje("Registro actualizado correctamente");
        }else{
            $res = $client->request("POST","http://codh.heladoobscuro.com.mx/public/api/employee-create",['form_params' => $data]);
            $response = json_decode($res->getBody());
            Message_Response::mensaje("Registro guardado correctamente");
        }
    }

    public function delete(Request $request){

        $client = new Client();

        if(empty($request['id'])){
            Message_Response::mensajeError("Ocurrio un error.!!");
        }
        $client->request("DELETE","http://codh.heladoobscuro.com.mx/public/api/employee-delete/".$request['id']);
        Message_Response::mensaje("Registro eliminado correctamente");
    }



}