<?php

namespace App\Http\Controllers;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class TypeController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => Type::orderBy('id', 'asc')->get()
            );
            return response($response, 200);
        } else {
            return  $this->show($id);
        }
    }


    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            $response = array(
                'message' => 'Failed',
                'status' => 400,
                'errors' => $validator->errors()
            );
            return response($response, 400);
        }
        else {
            $type = new Type();
            $type->title = $request->input('title');
            $type->user_id = $request->user()->id;
            $type->save();
            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $type
            );
            return response($response, 200);
        }
    }
}
