<?php

namespace App\Http\Controllers;
use App\SMSBulkModel;
use App\SMSTemplateModel;
use Illuminate\Http\Request;

use Auth;

class SmsBulk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $x = SMSBulkModel::orderBy("id", "desc")->get();
        $y = SMSTemplateModel::orderBy("id", "desc")->get();
		
		$data = [];
		
		foreach($x as $d){
			$t = SMSTemplateModel::where("id", $d->template_id);
			
			if($t->count() > 0){
				$d->title = $t->first()->title;
				
				$data[] = $d;
			}
		}
		
		$x = $data;
		
		return view("admin.sms.smsbulk.index", compact("x", "y"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $t = SMSTemplateModel::where("id", $request->template);
		
		if($t->count() > 0){
			$t = $t->first();
			
			//NUC130101000036249535fb5accab169524b40e5468bd1de5
			
			SMSBulkModel::create([
				"phone"		=> $request->phone,
				"template_id"	=> $t->id,
				"user_id"	=> Auth::user()->id
			]);
			
			return redirect("smsblast")->with('success', 'Message has been sent to '. $request->template .'.');
		}else{
			return redirect("smsblast")->with('error', 'Selected template is not available.');
		}
    }
	
	public function create_bulk(Request $request)
    {
        // $t = SMSTemplateModel::where("id", $request->template);
		
		// if($t->count() > 0){
			// $t = $t->first();
			
			// //NUC130101000036249535fb5accab169524b40e5468bd1de5
			
			// SMSBulkModel::create([
				// "phone"		=> $request->phone,
				// "template_id"	=> $t->id,
				// "user_id"	=> Auth::user()->id
			// ]);
			
			// return redirect("smsblast")->with('success', 'Message has been sent to '. $request->template .'.');
		// }else{
			// return redirect("smsblast")->with('error', 'Selected template is not available.');
		// }
		
		return redirect("smsblast")->with('error', 'SMS Bulk services is not enable yet.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
