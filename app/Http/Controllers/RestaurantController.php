<?php

namespace App\Http\Controllers;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class RestaurantController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => Restaurant::orderBy('id', 'asc')->get()
            );

            return response($response, 200);
        } else {

            return  $this->show($id);

        }
    }


    public function getMenuItemsByRestaurantId($id = null)
    {

        $resp = Restaurant::find($id)->menuItems;


        if ($resp) {
            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $resp
            );
            return response($response, 200);
        } else {
            $response = array(
                'message' => 'No Data',
                'status' => 400
            );
            return response($response, 400);
        }
    }


    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'type' => 'required',
            'lat' => 'required',
            'lng' => 'required'
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

            $restaurant = new Restaurant();
            $restaurant->name = $request->input('name');
            $restaurant->type = $request->input('type');
            $restaurant->lat = $request->input('lat');
            $restaurant->lng = $request->input('lng');
            $restaurant->user_id = $request->user()->id;
            $restaurant->save();

            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $restaurant
            );
            return response($response, 200);
        }
    }

}
