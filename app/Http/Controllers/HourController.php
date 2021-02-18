<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HourController extends Controller
{
    public function store(Request $request)
    {
        $entry = Hour::where('user_id', '=', $request->user()->id)->where('date', '=', $request->Date)->first();
        if($entry === null)
        {
            if(Auth::user()->isAbleTo('hours-create'))
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
            }
        }else{
            return redirect('/addNewHour')->with('date_duplicate', 'THE ENTERED DATE EXIST!');
        }
    }

    public function staffHour()
    {
        if(Auth::user()->hasRole('superadministrator'))
        {
            $staffsHour = DB::table('users')->join('hours', 'users.id' , '=', 'hours.user_id')->select('users.id', 'users.name', DB::raw('sum(hour) as sum'))
                ->groupBy('users.id')->orderByRaw('user_id ASC')->get();

            return view('super.staffHour', compact('staffsHour'));
        }
        else{
            return back()->with('hasNotPermission', 'YOU DO NOT HAVE ACCESS TO THIS SECTION!!!');
        }
    }
}
