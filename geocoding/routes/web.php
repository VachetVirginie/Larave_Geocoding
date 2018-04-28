<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('add', function(){
	return view('add');
});

Route::get('locations', function(){
	$data = [
		'points'=>App\Point::all()
	];
	return view('locations', $data);
});

Route::post('add', function(){
	$rules = [
		'address'=>'required'
	];

	$validation = Validator::make(Request::all(), $rules);
	if($validation->fails()){
		return back()->withErrors($validation)->withInput();
	}

	$param = array('address'=>Request::input('address'));
	$response = \Geocoder::geocode('json', $param);
	$location = json_decode($response);

	//dd($location);

	if($location->status == 'OK'){
		$name = $location->results[0]->address_components[0]->long_name;
		$address = $location->results[0]->formatted_address;
		$lat = $location->results[0]->geometry->location->lat;
		$lng = $location->results[0]->geometry->location->lng;

		if($lat && $lng){
			$point = new App\Point;
			$point->name = $name;
			$point->address = $address;
			$point->lat = $lat;
			$point->lng = $lng;
			if($point->save()){
				return back()->withSuccess('Adresse ajoutée');
			}
		}
	}
	else{
		dd($location);
	}
});
