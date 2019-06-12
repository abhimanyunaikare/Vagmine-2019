<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slot;
use Illuminate\Support\Facades\Hash;
use Auth;


class SlotController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');
        if(\Gate::allows('isAdmin') || \Gate::allows('isEditor'))
        {
            return Slot::latest()->paginate(5);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'title'=>'required|max:191',
          'place'=>'required|max:191',
          'progtype'=>'required|max:191',
          'userid'=>'required',
        ]);

        return Slot::create([
          'title' => $request['title'],
          'start_date' =>  date("Y-m-d H:i:s", strtotime($request['start_date']) + 330*60),
          'end_date' => date("Y-m-d H:i:s", strtotime($request['end_date']) + 330*60),
          'place' => $request['place'],
          'progtype' => $request['progtype'],
          'userid' => $request['userid'],
          'creatorid' => Auth::user()->id,
        ]);

        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slot = Slot::findOrFail($id);
        $this->validate($request,[
          'title'=>'required|max:191',
          'place'=>'required|max:191',
          'progtype'=>'required|max:191',
        ]);
        $slot->title = $request->title;
        $slot->place = $request->place;
        $slot->progtype = $request->progtype;
        $slot->start_date = date("Y-m-d H:i:s", strtotime($request->start_date) + 330*60);  // 5:30 Hrs added due to error in dateitme format.
        $slot->end_date = date("Y-m-d H:i:s", strtotime($request->end_date) + 330*60);
        $slot->userid = $request->userid;
        $slot->creatorid = Auth::user()->id;
        $slot->save();

        return ['message' => 'update the info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $slot =Slot:: findOrFail($id);
        $slot->delete();
        return ['message'=>'Slot deleted'];
    }

    public function search(){
        if($search =\Request::get('q')){
            $slots = Slot::where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%")
                      ->orwhere('place','LIKE',"%$search%")
                      ->orwhere('progtype','LIKE',"%$search%");
            })->paginate(10);
        }else{
            $slots = Slot::latest()->paginate(5);
        }
        return $slots;
    }
}
