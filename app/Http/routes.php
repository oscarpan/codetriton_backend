<?php

use App\FBUser;
use App\Match;
use App\Message;
use App\Offer;

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'api'], function () {

    Route::get('offers', function(){
        $offers = Offer::with('user')->get();
        return response()->json($offers);
    });

    Route::post('createOffer', function(Request $request){
        $offer = Offer::create($request->all());
        return response()->json($offer);
    });

    Route::post('userLogin', function(Request $request){
        $user = FBUser::find($request->get('id'));

        if($user == NULL){
            $user = FBUser::create($request->all());
        }

        return response()->json($user);
    });

//    Route::post('submitscore', function(Request $request){
//        \App\Score::create($request->all());
//        return response()->json(\App\Score::where('level_id', '=', $request->get('level_id'))->get()->sortByDesc('score')->take(5)->toArray());
//    });
});