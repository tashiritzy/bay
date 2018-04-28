<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use DB;

use App\Breg;
use Mail;

class BregController extends Controller
{
    //
	public function index()
	{
		$bregs =DB::table('breg')->paginate(5);
		return view('breg.index', compact('bregs'));
		
		$tags = DB::table('tags')->paginate(7);

    	return view('tags',compact('tags'));
		
		$search = \Request::get('search');
		$bregs = Breg::where('businessname','like','%'.$search.'%')->orderBy('id')->paginate(5);
		return view('breg.index', compact('bregs'));
		
		// $items = Breg::latest()->paginate(5);

        // return response()->json($items);
	}
	
	public function create()
	{
		return view('breg.create');
	}
	public function store(Request $request)
	{
		$this->validate($request,[
			'businessname' => 'required',
			'businesstype' => 'required',
			'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'CaptchaCode' => 'required|valid_captcha',
		]);
		
		$breg = new Breg;
		
		///////////////////////////image upload/////////////////////
		
		// $this->validate($request, [

            // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        // ]);


        $imageName = time().'.'.$request->avatar->getClientOriginalExtension();

        $request->avatar->move(public_path('avatar'), $imageName);


    	// return back()

    		// ->with('success','Image Uploaded successfully.')

    		// ->with('path',$imageName);
		
		///////////////////////////image end/////////////////////
		
		
		$breg->businessname = $request->businessname;
		$breg->businesstypeid = $request->businesstype;
		$breg->locationid = $request->location;
		$breg->email = $request->email;
		$breg->phone = $request->phone;
		$breg->description = $request->description;
		$breg->address = $request->address;
		$breg->imagepath = $imageName;
		$breg -> save();
		return redirect('/breg')->with('message','Registration Successful!');
	}
	public function verify()
	{
		//return view('breg.verify');
		$bregs =DB::table('breg')->paginate(5);
		return view('breg.verify', compact('bregs'));
	}
	public function approve(Request $request, $id)
	{
		$breg = Breg::find($id);
		$breg->publish = 1;
		//$breg->post = $request->post;
		
		//public $businessname = $breg->businessname;
		
		$breg -> save();
		
		///////////////////////////mail//////////////////
		$title = "Tashi Mail";
		$content = $breg->businessname;
		$email_to = $breg->email;
		
		//$attach = $request->file('file');

        Mail::send('breg.emails.regapprove', ['title' => $title, 'content' => $content], function ($message) use ($email_to)
        {

            $message->from('noreply@gmail.com', 'Bhutan Administration');

            $message->to($email_to);
			
			//Attach file
            //$message->attach($attach);

            //Add a subject
            $message->subject("Hello from Tashi");

        });

        //return response()->json(['message' => 'Request completed']);
		////////////////////////mail end/////////////////
		
		return redirect('breg/verify')->with('message','Post has been approved!');
	}
	
	public function show($id)
	{
		$breg = Breg::find($id);
		if(!$breg){
			abort(404);
		}
		return view('breg.details')->with('detailpage',$breg);
	}
	public function edit($id)
	{
		$breg = Breg::find($id);
		if(!$breg){
			abort(404);
		}
		return view('breg.edit')->with('detailpage',$breg);
	}
	
	public function update(Request $request, $id)
	{
		// $this->validate($request,[
			// 'title'=>'required',
			// 'post' => 'required',
		// ]);
		
		// $breg = Breg::find($id);
		// $breg->title = $request->title;
		// $breg->post = $request->post;
		// $breg -> save();
		// return redirect('breg')->with('message','Post has been updated!');
		
		$edit = Breg::find($id)->update($request->all());

        return response()->json($edit);
	}
	
	public function destroy($id)
	{
		$breg = Breg::find($id);
		$breg->delete();
		return redirect('breg')->with('message','Post has been deleted!');
	}
}
