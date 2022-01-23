<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Schedule;
use App\Models\Train;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $title = 'Train Schedule Management';
        $locations = Location::get();
        $trains = Train::where('status', 1)->get();
        $schedules = Schedule::where('status', 1)->with('locationdata')->with('traindata')->get();

        return view('pages.train_schedule', compact(['title', 'locations', 'trains','schedules']));
    }

    public function enroll(Request $request)
    {

        $request->validate([
            'train' => 'required|exists:trains,id',
            'location' => 'required|exists:locations,id',
            'slot' => 'required',
            'status' => 'required|in:1,2',
            'isnew' => 'required|in:1,2'
        ]);

        if ($request->isnew == 1) {
            Schedule::create([
                'train' => $request->train,
                'location' => $request->location,
                'slot' => $request->slot,
                'status' => $request->status
            ]);
        } else {
            $request->validate([
                'id' => 'required|exists:schedules,id'
            ]);
            Schedule::where('id', $request->id)->update([
                'train' => $request->train,
                'location' => $request->location,
                'slot' => $request->slot,
                'status' => $request->status
            ]);
        }
        return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Schedule Successfully ' . (($request->isnew == 1) ? 'Registered' : 'Updated')]);
    }

    public function get(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:schedules,id'
        ]);

        $data=Schedule::where('id', $request->id)->first();

        $data['slot']=Carbon::parse($data->slot)->format('Y-m-d\TH:i');

        return $data;
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:schedules,id'
        ]);

        Schedule::where('id', $request->id)->delete();
    }
}
