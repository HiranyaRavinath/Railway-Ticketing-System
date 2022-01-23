<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Train;
use App\Models\TrainTickets;
use Illuminate\Http\Request;

class TrainTicketController extends Controller
{
    public function index()
    {
        $title = 'Train Ticket Management';
        $locations = Location::get();
        $trains = Train::where('status', 1)->with('startdata')->with('enddata')->get();
        $traintickets = TrainTickets::whereIn('status', [1, 2])->with('traindata')->with('startdata')->with('enddata')->get();

        return view('pages.train_tickets', compact(['title', 'locations', 'trains', 'traintickets']));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'train' => 'required|exists:trains,id',
            'class' => 'required|in:' . implode(", ", array_keys(TrainTickets::$classes)),
            'start' => 'required|exists:locations,id',
            'end' => 'required|exists:locations,id|different:start',
            'isforeigner' => 'required|in:1,2',
            'price' => 'required|numeric',
            'status' => 'required|in:1,2',
            'isnew' => 'required|in:1,2'
        ]);

        if ($request->isnew == 1) {
            TrainTickets::create([
                'start' => $request->start,
                'end' => $request->end,
                'train' => $request->train,
                'class' => $request->class,
                'price' => $request->price,
                'isforeigner' => $request->isforeigner,
                'status' => $request->status,
            ]);
        } else {

            $request->validate([
                'id' => 'required|exists:train_tickets,id'
            ]);

            TrainTickets::where('id', $request->id)->update([
                'start' => $request->start,
                'end' => $request->end,
                'train' => $request->train,
                'class' => $request->class,
                'price' => $request->price,
                'isforeigner' => $request->isforeigner,
                'status' => $request->status,
            ]);
        }

        return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Train Ticket Successfully ' . (($request->isnew == 1) ? 'Registered' : 'Updated')]);
    }

    public function get(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:train_tickets,id'
        ]);

        return TrainTickets::where('id', $request->id)->first();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:train_tickets,id'
        ]);

        TrainTickets::where('id', $request->id)->delete();
    }
}
