<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders;

        if ($orders) {
            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $orders
            );
            return response($response, 200);
        } else {
            $response = array(
                'message' => 'Failed',
                'status' => 400
            );
            return response($response, 400);        }
    }


    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'menu_items' => 'required',
            'restaurant_id' => 'required',
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

            $order = new Order();
            $order->restaurant_id = $request->input('restaurant_id');
            $order->user_id = $request->user()->id;
            $order->title = $request->input('title');
            $order->menu_items = $request->input('menu_items');
            $order->save();

            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $order
            );
            return response($response, 200);
        }
    }
}
