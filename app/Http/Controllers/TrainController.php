<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Train;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainController extends Controller
{
    public function index()
    {
        $title = 'Train Management';
        $locations = Location::get();
        $trains = Train::whereIn('status', [1, 2])->with('startdata')->with('enddata')->get();

        return view('pages.trains', compact(['title', 'locations', 'trains']));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'alias' => 'required|string',
            'start' => 'required|exists:locations,id',
            'end' => 'required|exists:locations,id|different:start',
            'status' => 'required|in:1,2',
            'perbox' => 'required|numeric',
            'windowed' => 'required|numeric',
            'nonwindowed' => 'required|numeric',
            'isnew' => 'required|in:1,2'
        ]);

        if ($request->isnew == 1) {
            Train::create([
                'start' => $request->start,
                'end' => $request->end,
                'alias' => $request->alias,
                'status' => $request->status,
                'seatsperbox' => $request->perbox,
                'windowed' => $request->windowed,
                'nonwindowed' => $request->nonwindowed
            ]);
        } else {

            $request->validate([
                'id' => 'required|exists:trains,id'
            ]);

            Train::where('id', $request->id)->update([
                'start' => $request->start,
                'end' => $request->end,
                'alias' => $request->alias,
                'status' => $request->status,
                'seatsperbox' => $request->perbox,
                'windowed' => $request->windowed,
                'nonwindowed' => $request->nonwindowed
            ]);
        }

        return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Train Successfully ' . (($request->isnew == 1) ? 'Registered' : 'Updated')]);
    }

    public function get(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trains,id'
        ]);

        return Train::where('id', $request->id)->first();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trains,id'
        ]);

        Train::where('id', $request->id)->delete();
    }
}
