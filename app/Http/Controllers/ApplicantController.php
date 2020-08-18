<?php

namespace App\Http\Controllers;

use App\Paid;
use App\Photo;
use DataTables;
use App\Decline;
use App\Applicant;
use App\Inspection;
use App\HousePerspective;
use Illuminate\Http\Request;
use App\Events\ApplicationStatusChanged;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->from_date))
            {
                $data = Applicant::whereBetween('created_at', array($request->from_date, $request->to_date))
                ->where('inspection_status','=','0')
                ->where('paid_status','=','0')
                ->where('decline_status','=','0')
                ->get();
            }
            else
            {
                $data = Applicant::where('inspection_status','=','0')
                ->where('paid_status','=','0')
                ->where('decline_status','=','0')
                ->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-target="#checkApplicant" data-id="'.$row->id.'" data-original-title="Edit" data-placement="top" title="Add" class="edit btn btn-primary btn-sm checkApplicant">Check</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-placement="top" title="Good for inspection" class="btn btn-success btn-sm inspectionApplicant">Inspection</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-placement="top" title="Decline applicant" class="btn btn-danger btn-sm declineApplicant">Decline</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('applicants.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id']=$photo->id;
        }
        if($file = $request->file('house_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('house',$name);
            $photo = HousePerspective::create(['path'=>$name]);
            $input['house_id']=$photo->id;
        }
        Applicant::create($input);
        $id = Applicant::latest()->first();
        event(new ApplicationStatusChanged($id));
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Applicant::find($id);
        $photo_src = $applicant->photo->path;
        $house_src = $applicant->house->path;
        $applicant->push($photo_src);
        $applicant->push($house_src);
        return response()->json($applicant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function forInspection($id){
        $applicant = Applicant::find($id);
        $applicant->inspection_status = '1';
        $applicant->save();
        $applicantInspection = new Inspection;
        $applicantInspection->applicant_id = $applicant->id;
        $applicantInspection->save();
        return response()->json(['success'=>'status updated.']);
    }
    public function applicantDeclined($id){
        $applicant = Applicant::find($id);
        $applicant->decline_status = '1';
        $applicant->save();
        $applicantDeclined = new Decline;
        $applicantDeclined->applicant_id = $applicant->id;

        return response()->json(['success'=>'status updated.']);
    }
    public function applicantPaid($id){
        $applicant = Applicant::find($id);
        $applicant->paid_status = '1';
        $applicant->save();
        $applicantPaid = new Paid;
        $applicantPaid->applicant_id = $applicant->id;
        return response()->json(['success'=>'status updated.']);
    }
}
