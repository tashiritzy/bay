<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use DB;
use Validator;

use App\Bssr;
use App\Picture;
use App\Advcomment;
use App\Category;
use App\Place;
use App\User;
use Auth;

use Log;

use Image;
use File;
use Mail;

// -- file upload --
use Symfony\Component\HttpKernel\Tests\Debug\FileLinkFormatterTest;
use Illuminate\Support\Facades\Storage;

class BssrController extends Controller
{
    //
	public function bssr()
	{
		$cat = DB::table('category')
			->get();
			
		$place = DB::table('place')
			->get();

		$bssr = DB::table('adv')
           		->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
                        ->leftjoin('advcomment', 'adv.id', '=', 'advcomment.advid')
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname', 'advcomment.comment')
			->where('adv.status', '=', '1')
                        ->orderby('adv.created_at', 'DESC')           		
			->groupBy('adv.id')
			->paginate(20);

		return view('bssr', compact('bssr', 'cat', 'place'));
	}

    public function index($id = null) 
	{
			
		$bssr = DB::table('adv')
           		->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
            		->select('adv.*', 'picture.path as path', 'place.placename', 'category.categoryname')
                        ->where('adv.status', '=', '1')
            		->orderby('adv.created_at', 'DESC')           		
			->groupBy('adv.id')
			->paginate(10);
			//->get()
			//->toArray();
		
			Log::info($bssr);
			
			return $bssr;
		
		$place = DB::table('place')
			->get()
			->toArray();
			
	}

	public function bssrsearch(Request $request)
	{

        $cat = DB::table('category')
			->get();
			
		$place = DB::table('place')
			->get();

		$search = $request->searchkey;
				
		$bssr = DB::table('adv')
           		->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
			->where('adv.status', '=', '1')
			->where('adv.description','like','%'.$search.'%')
			->orWhere('adv.advtopic','like','%'.$search.'%')
			->where('adv.status', '=', '1')
			->orderby('adv.created_at', 'DESC')           		
			->groupBy('adv.id')
			->paginate(20);
		return view('bssr', compact('bssr', 'cat', 'place'));
	}

    public function filter(Request $request)
	{
		
		$search = $request->searchkey;
		$pricemin = $request->pricemin;
		$pricemax = $request->pricemax;
		$category = $request->category;
		$place = $request->place;
		
		if($search != '' && $pricemin != '' && $pricemax != '' && $category != '' && $place != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.description','like','%'.$search.'%')
				->whereBetween('adv.price', array($pricemin, $pricemax)) 
				->where('adv.placeid', '=', $place)
				->where('adv.categoryid', '=', $category)
				->orwhere('adv.advtopic','like','%'.$search.'%')
				->whereBetween('adv.price', array($pricemin, $pricemax))
				->where('adv.placeid', '=', $place)
				->where('adv.categoryid', '=', $category)
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		
        else if($place != '' && $category != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.categoryid', '=', $category)
				->where('adv.placeid', '=', $place)
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}

        else if($pricemin != '' && $pricemax != '' && $category != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.categoryid', '=', $category)
				->whereBetween('adv.price', array($pricemin, $pricemax))
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		else if($category != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.categoryid', '=', $category)
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		
		else if($pricemin != '' && $pricemax != '' && $place != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.placeid', '=', $place)
				->whereBetween('adv.price', array($pricemin, $pricemax))
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		
		else if($place != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.placeid', '=', $place)
				//->whereBetween('adv.price', array($pricemin, $pricemax))
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		else if($search != '' && $pricemin != '' && $pricemax != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.description','like','%'.$search.'%')
				->whereBetween('adv.price', array($pricemin, $pricemax)) 
				->orwhere('adv.advtopic','like','%'.$search.'%')
				->whereBetween('adv.price', array($pricemin, $pricemax))
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		else if($search != '')
		{
				
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				->where('adv.description','like','%'.$search.'%')
				->orwhere('adv.advtopic','like','%'.$search.'%')
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();			
				->paginate(10);
			//return view('bssr', compact('bssr', 'cat', 'place'));
		}
		else
		{
			$bssr = DB::table('adv')
				->leftjoin('picture', 'adv.id', '=', 'picture.advid')
				->leftjoin('place', 'adv.placeid', '=', 'place.id') 
				->leftjoin('category', 'adv.categoryid', '=', 'category.id')
				->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
				//->where('place.id', '=', $place)
				->orderby('adv.created_at', 'DESC')           		
				->groupBy('adv.id')
				//->get()
				//->toArray();
				->paginate(10);
		}

                Log::info($request);
		
		return ($bssr);
	}
	

	public function details($id)
	{
		//$bssr = Bssr::find($id);
		
		$bssr = DB::table('adv')
			->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
			->leftjoin('users', 'adv.userid', '=', 'users.id')
			->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname', 'users.name as uname')
			->where('adv.id', $id)
			->get();
		
		$cmmt = DB::table('advcomment')
			->leftjoin('users', 'advcomment.userid', '=', 'users.id')
			//->leftjoin('users', 'adv.userid', '=', 'users.id')
			->select('advcomment.comment', 'users.name as cname', 'users.email as uemail', 'users.phone as uphone', 'advcomment.userid', 'advcomment.id')
			->where('advcomment.advid', $id)
			->get();
		
		$images = DB::table('picture')
			->where('advid', '=', $id)
			->get();

		
		
		$message = "";
            		
		if(!$bssr){
			abort(404);
		}
		return view('bssr.details', compact(['bssr', 'cmmt', 'images', 'message']));
	}

	public function create()
	{
		$cat = DB::table('category')
			->get();
			
		$place = DB::table('place')
			->get();
		
		return view('bssr.create', compact(['cat', 'place']));
	}

	public function storeadv(Request $request)
	{		
		$this->validate($request,[
			'advtopic' => 'required',
			'category' => 'required',
                        'phone' => 'required'
		]);
		
		$bssr = new Bssr;
		
		$pic = new Picture;		
		
		$userid = (!Auth::guest()) ? Auth::user()->id : null ;
		
		$bssr->userid = $userid;
		$bssr->advtopic = $request->advtopic;
		$bssr->categoryid = $request->category;
		$bssr->placeid = $request->location;
		$bssr->email = $request->email;
		$bssr->phone = $request->phone;
		$bssr->price = $request->price;
		$bssr->description = $request->description;
		$bssr -> save();
		
		$addtitle = $request->advtopic;
		$maxid = Bssr::find(DB::table('adv')->max('id'));
		$maxidd = $maxid->id;		
		$pic->advid = $maxidd;	
		
		return redirect('/imageupload/'.$maxidd);
	}
	public function getAdvImages($advid)
	{
		$images = DB::table('picture')
           		->rightjoin('adv', 'picture.advid', '=', 'adv.id')
            		->select('picture.advid','picture.path', 'adv.advtopic', 'adv.id', 'picture.id as picid')
            		->where('adv.id', $advid)
					->get();
		
		return ['files' => $images];
	
	}

	public function getAdv($advid)
	{
		$adv = DB::table('adv')
					->select('adv.*')
            		->where('adv.id', $advid)
            		;
		
		return $adv;
	
	}
		
	public function imageupload(Request $request)
	{
		if ($request->isMethod('get'))
		{
		
			$advid = $request->advid;

			$adv = $this->getAdv($advid)->first();

			if($adv->userid != Auth::user()->id)
			{
				abort(403, 'Unauthorized action.');
			}

	        return view('bssr.imageupload',compact('adv'));
	    }

		if ($request->isMethod('post'))
		{
			$advid = $request->advID;
		
			$validator = Validator::make($request->file(), [
			
			    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
			
			]);

			if ($validator->fails()) {

	            $errors = [];
	            foreach ($validator->messages()->all() as $error) {
	                array_push($errors, $error);
	            }

	            //return response()->json(['errors' => $errors, 'status' => 400], 400);

	         }
		
			$input['path'] = time().'.'.$request->file('image_file')->getClientOriginalExtension();
			
			$request->file('image_file')->move('avatar', $input['path']);
			
			$image = Image::make(sprintf('avatar/%s', $input['path']))->resize(null, 500, function($cnts){$cnts->aspectRatio();})->save();

			$input['advid'] = $advid;
			
			Picture::create($input);
			
			return redirect('/images/'.$advid);
		}
	
	}

	public function imagedestroy(Request $request)
	{
		$advid=$request['advid'];
		$id = $request['pic_id'];
		
		$img = Picture::find($id);

		$image_path = "avatar/".$img->path;

		if (File::exists($image_path)) {
			unlink($image_path);
			$img->delete();
		 }
		 else
		 {
			abort(404, 'Unauthorized action.');
		 }
		 	
		return redirect('/imageupload/'.$advid);
	}	
	
	public function comment(Request $request)
	{
		//echo "test";		
		
		$this->validate($request,[
			'comment' => 'required',
		]);
		
		$bssr = new Advcomment;
		
		$userid = (!Auth::guest()) ? Auth::user()->id : null ;
		
		$bssr->userid = $userid;
		$bssr->advid = $request->advid;
		$bssr->comment = $request->comment;
		
		$bssr -> save();
		
		// ----------------------------maillllllllll -----------------------------
		
		$mailt = DB::table('adv')
			->leftjoin('users', 'adv.userid', '=', 'users.id')
			->select('adv.advtopic', 'adv.email as ademail', 'users.email as adowneremail')
			->where('adv.id', '=', $bssr->advid)
			->get();
			
		$cmmtuser = DB::table('users')
			->where('users.id','=',$userid)
			->select('users.*')
			->get();
		
		$mailcont = array('mcomment'=>$bssr->comment, 'madvid'=>$bssr->advid, 'madvtopic'=>$mailt->first()->advtopic, 'poster'=>$cmmtuser->first()->name);
		
		//$title = "Tashi Mail";
		//$content = "Mail Content";
		$email_to = $mailt->first()->adowneremail;
		
		//$attach = $request->file('file');

		Mail::send('emails.commentnotify', $mailcont, function ($message) use ($email_to)
		{
		
		    $message->from('noreply@druklink.net', 'Rent Exchange Buy Sell Administration');
		
		    $message->to($email_to);
				
		    $message->subject("REBS Mail Notification");
		 });
		//------------------------- mail end----------------------------------
		
		$message = "Your comment posted successfully. You can view your comments on your home page.";
		
		return $this->details($bssr->advid);
		
		//return redirect('/bssr')->with('message','Comment Posted Successful!');
	}
	public function commentdelete(Request $request)
	{
		$cmmtid = $request->cmmtid;
		
		$bssr = Advcomment::find($cmmtid);
		$bssr->delete();
		$advid = $bssr->advid;
		
		//$message = "Your has been deleted successfully.";
		
		return $this->details($advid);
		
	}
	public function deleteadv(Request $request)
	{
		$advid = $request->advid;
		
		DB::table('advcomment')->where('advid', $advid)->delete();
		
		$pic = DB::table('picture')->where('advid', $advid)->get();
		
		//$image = $pic->path->get();
		
		//File::delete(public_path("avatar/".$image));
		
		//echo $image->path;
		if($pic)
		{
			foreach($pic as $pict)
			{
				$image_path = public_path("avatar/".$pict->path);
				
				//echo ($pic['path']);
				//File::delete(public_path("avatar/".$img));
				
				if (File::exists($image_path)) {
					//File::delete($image_path);
					unlink($image_path);
				}
				
				 //$pict->delete();
				 $image_path."<br>";
				 
				 
			}
			
		}
		DB::table('adv')->where('id', $advid)->delete();
		
		$userid = (!Auth::guest()) ? Auth::User()->id : null ;
				
		$bssr = Bssr::leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
			->leftjoin('picture', 'adv.id', '=', 'picture.advid')
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
            		->where('adv.userid', '=', $userid)
            		->groupBy('adv.id')
            		->orderby('adv.created_at', 'DESC')
            		->paginate(20);
            		
            	$message = "Your ad has been deleted successfully!";
            		
		return view('userhome', compact('bssr', 'message'));
	}
	public function categoryview($cat)
	{
		return view('bssr.category');
	}
	public function categoryviewData($catid)
	{
		$bssr = Bssr::leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
			->leftjoin('picture', 'picture.advid', '=', 'adv.id')
            		->select('adv.*', 'picture.path as path', 'place.placename as placename', 'category.categoryname as categoryname')
            		->where('category.categoryname', 'like', '%'.$catid.'%')
					->where('adv.status', '=', '1')
            		->groupBy('adv.id')
            		//->groupBy('adv.id')
            		->orderby('adv.created_at', 'DESC')
					->paginate(10);
		
		$cat = DB::table('category')
					->select('category.*')
					->where('category.categoryname', 'like', '%'.$catid.'%')
					->first();
		
		return ['bssr' => $bssr, 'catid' => $catid, 'cat' => $cat];		
	}
	public function userhome()
	{
		$userid = (!Auth::guest()) ? Auth::User()->id : null ;
		            		
		return view('userhome');
	}
	
	public function useradvs()
	{
		$userid = (!Auth::guest()) ? Auth::User()->id : null ;
		
		//$user = Auth::User();     
		//echo $userid = $user->id;
		
		$bssr = Bssr::leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
			->leftjoin('picture', 'adv.id', '=', 'picture.advid')
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
            		->where('adv.userid', '=', $userid)
            		->groupBy('adv.id')
            		->orderby('adv.created_at', 'DESC')
            		->paginate(20);
            		//->get();
            	//$pic = Picture::find($advid);
            		
		return view('useradvs')->with('bssr', $bssr);
	}
	
	public function commentedadvs()
	{
		$userid = (!Auth::guest()) ? Auth::User()->id : null ;
		
		//$user = Auth::User();     
		//echo $userid = $user->id;
		
		$bssr = Bssr::leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
			->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('advcomment', 'adv.id', '=', 'advcomment.advid')
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname', 'advcomment.comment')
            		->where('advcomment.userid', '=', $userid)
            		->groupBy('adv.id')
            		->orderby('adv.created_at', 'DESC')
            		->paginate(20);
            		//->get();
            	//$pic = Picture::find($advid);
            		
		return view('usercommented')->with('bssr', $bssr);
	}
	public function postadv(Request $request)
	{
		$id = $request->advid;
		$addtitle = $request->adtitle;
		
		$message = "Your post ".$addtitle." has successfully been posted.";
		
		$post = Bssr::find($id);
		$post->status = 1;
				
		$post -> save();
		
		$message = "Your ad has been posted successfully. Keep checking it for comments from others.";
		
		return view('userhome', compact('message'));
	
	}
	public function myaccount()
	{
		$userid = (!Auth::guest()) ? Auth::user()->id : null ;
					
		$cmmtuser = DB::table('users')
			->where('users.id','=',$userid)
			->select('users.*')
			->get();
			
		return view('myaccount', compact('cmmtuser'));
	}
	public function myaccountupdate(Request $request)
	{
		//$this->validate($request,[
		//	'name' => 'required|max:255',
		//	'email' => 'required|email|max:255|unique:users|confirmed',
		//	'phone' => 'required|max:30',
		//]);
		
		$id = (!Auth::guest()) ? Auth::user()->id : null ;
		
		$usr = User::find($id);
		$usr->name = $request->name;
		$usr->phone = $request->phone;
		$usr->email = $request->email;
				
		$usr -> save();
				
		return view('userhome')->with('message', 'Your account updated successfully');
	}

    /**
     * Load Files View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function files()
    {
        return view('bssr.imageupload');
    }

    /**
     * List Uploaded files
     *
     * @return array
     */
    public function listFiles(Request $request)
    {
        return ['files' => DB::table('picture')
            		->select('picture.*')
            		->where('advid', $request->advid)
            		->get()
        	];
    }


    /**
     * Upload new File
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->file(), [
            'image_file' => 'required|image|max:5048',
        ]);

        if ($validator->fails()) {

            $errors = [];
            foreach ($validator->messages()->all() as $error) {
                array_push($errors, $error);
            }

            return response()->json(['errors' => $errors, 'status' => 400], 400);
        }

        $file = Picture::create([
            'path' => $request->file('image_file')->getClientOriginalName()
        ]);

        $request->file('image_file')->move('avatar', $file->id . '.' . $file->type);

        return response()->json(['errors' => [], 'files' => Picture::all(), 'status' => 200], 200);
    }

    /**
     * Delete existing file from the server
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Storage::delete(__DIR__ . '/../../../image_uploads/' . $request->input('id'));

        File::find($request->input('id'))->delete();

        return response()->json(['errors' => [], 'message' => 'File Successfully deleted!', 'status' => 200], 200);
    }

}
