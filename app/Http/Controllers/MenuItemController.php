<?php

namespace App\Http\Controllers;
use App\MenuItem;
use App\Restaurant;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class MenuItemController extends Controller
{
    public function index($filters = null, $lat = null, $lng = null)
    {
        $kms = 5;
        $filtersArray = explode(',', $filters);
        $itemsWithinDist = MenuItem::orderBy('id', 'desc')
            ->join('restaurants', 'menu_items.restaurant_id', '=', 'restaurants.id')
            ->select(DB::raw(
                'menu_items.*, 
                    restaurants.lat as lat,
                    restaurants.lng as lng,
                    restaurants.name as restaurant_name,
                    restaurants.type as restaurant_type' //not sure if we need this..
            ))
            ->whereBetween('lat', [($lat - ($kms*0.0117)), ($lat + ($kms*0.0117))])
            ->whereBetween('lng', [($lng - ($kms*0.0117)), ($lng + ($kms*0.0117))])
            ->whereIn('menu_items.type', $filtersArray)
            ->get();


        //TODO Do something with filters
        //I think we should first find the restaurants that match the lat and lng..
        //(what about restaurant type? maybe just used for display..)
        // then find all menu items for these restaurants that match with the mood filters
            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $itemsWithinDist,
                'filters' => $filtersArray,
                'lat' => $lat,
                'lng' => $lng
            );

            return response($response, 200);

    }


    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'image' => 'required',
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

            $menuItem = new MenuItem();
            $menuItem->name = $request->input('name');
            $menuItem->type = $request->input('type');
            $menuItem->price = $request->input('price');
            $menuItem->image = $request->input('image');
            $menuItem->restaurant_id = $request->input('restaurant_id');
            $menuItem->user_id = $request->user()->id;
            $menuItem->save();

            $response = array(
                'message' => 'Success',
                'status' => 200,
                'data' => $menuItem
            );
            return response($response, 200);
        }
    }

}
