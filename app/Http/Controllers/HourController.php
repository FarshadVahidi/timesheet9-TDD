<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HourController extends Controller
{
    public function store(Request $request)
    {
        $entry = Hour::where('user_id', '=', $request->user()->id)->where('date', '=', $request->Date)->first();
        if($entry === null)
        {
            if(Auth::user()->isAbleTo('hour-create'))
            {

                try{
                    $hour = new Hour();
                    $hour->user_id = $request->user()->id;
                    $hour->date = $request->Date;
                    $hour->hour = $request->Hour;
                    $hour->save();

                    return back()->with('date_added', 'Date and Hour has been added successfully.');
                }catch(\Exception $exception){
                    return Redirect::back()->withErrors(['msg', 'The Message']);
                }
            }else{
                return back()->with('date_duplicate', 'THE ENTERED DATE EXIST!');
            }
        }
    }
}
