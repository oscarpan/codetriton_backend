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

    Route::get('users', function () {
        return response()->json(FBUser::all());
    });

    Route::get('offers', function () {
        $offers = Offer::with('user')->with('matches')->get();

        return response()->json($offers);
    });

    Route::post('createOffer', function (Request $request) {
        $offer = Offer::create($request->all());

        return response()->json($offer);
    });

    Route::get('match/{matchid}', function ($matchid) {
        $match = Match::with('messages')->find($matchid);

        return response()->json($match);
    });

    Route::get('matches/{userid}', function ($userid) {
        $user = FBUser::find($userid);
        $data = [
            'guest_matches' => $user->guest_matches()->toArray(),
            'host_matches'  => $user->host_matches()->toArray(),
        ];

        return response()->json($data);
    });

    Route::post('createMatch', function (Request $request) {
        $match = Match::create($request->all());
        $offer = Offer::find($request->get('offer_id'));
        $user = FBUser::find($request->get('guest_id'));
        $user->decrement('points', $offer->points);
        $user->save();

        return response()->json($match);
    });

    Route::post('createMessage', function (Request $request) {
        $message = Message::create($request->all());

        return response()->json($message);
    });

    Route::post('updateGuestRating', function (Request $request) {
        $match = Match::find($request->get('match_id'));
        $match->guest_rating = $request->get('guest_rating');

        return response()->json($match);
    });
    Route::post('updateHostRating', function (Request $request) {
        $match = Match::find($request->get('match_id'));
        $match->host_rating = $request->get('host_rating');

        return response()->json($match);
    });

    Route::get('offer/{offerid}/{userid}', function ($offerid, $userid) {
        $offer = Offer::find($offerid);

        $match = Match::where('offerid', '=', $offerid)->where('');

        $data = [
            'offer' => $offer->toArray(),
            '',
        ];

        return response()->json($data);
    });

    Route::post('userLogin', function (Request $request) {
        $user = FBUser::find($request->get('id'));

        if ($user == null) {
            $user = FBUser::create($request->all());
        }

        return response()->json($user);
    });

//    Route::post('submitscore', function(Request $request){
//        \App\Score::create($request->all());
//        return response()->json(\App\Score::where('level_id', '=', $request->get('level_id'))->get()->sortByDesc('score')->take(5)->toArray());
//    });
});
