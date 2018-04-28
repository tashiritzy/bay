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
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
			->orderby('adv.created_at', 'DESC')           		
			->groupBy('adv.id')
			->paginate(20);

		return view('bssr', compact('bssr', 'cat', 'place'));
		//return Bssr::orderBy('id', 'asc')->get();
	}
	
	public function index($id = null) 
	{
		//return DB::table('adv')->get();
			
		$bssr = DB::table('adv')
           		->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
            		->select('adv.*', 'picture.path as path', 'place.placename', 'category.categoryname')
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
			
		//sendJson(array('bssr'=>$bssr, 'place'=>$place));
		//return array('bssr' => $bssr, 'cat'   => $cat, 'place' => $place);
			
	}
    
	
	public function bssrsearch(Request $request)
	{
		$search = $request->searchkey;
		
		$cat = DB::table('category')
			->get();
			
		$place = DB::table('place')
			->get();
		
		$bssr = DB::table('adv')
           		->leftjoin('picture', 'adv.id', '=', 'picture.advid')
			->leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
			->where('adv.description','like','%'.$search.'%')
			->orWhere('adv.advtopic','like','%'.$search.'%')
			->orderby('adv.created_at', 'DESC')           		
			->groupBy('adv.id')
			->paginate(20);
		return view('bssr', compact('bssr', 'cat', 'place'));
	}
	
	public function filter(Request $request)
	{
		$cat = DB::table('category')
			->get();
			
		$place = DB::table('place')
			->get();
		
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
            		->select('adv.*', 'picture.path', 'place.placename', 'category.categoryname')
            		->where('adv.id', $id)
            		->get();
		
            	$cmmt = DB::table('advcomment')
            		->leftjoin('users', 'advcomment.userid', '=', 'users.id')
            		//->leftjoin('users', 'adv.userid', '=', 'users.id')
            		->select('advcomment.comment', 'users.name', 'users.email as uemail', 'users.phone as uphone', 'advcomment.userid', 'advcomment.id')
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
		//echo "test";		
		
		$this->validate($request,[
			'advtopic' => 'required',
			'category' => 'required',
			//'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			//'CaptchaCode' => 'required|valid_captcha',
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
		//$breg->address = $request->address;
		//$bssr->pictureid = $imageName;
		$bssr -> save();
		
		$addtitle = $request->advtopic;
		//$pic->path = $imageName;
		$maxid = Bssr::find(DB::table('adv')->max('id'));
		$maxidd = $maxid->id;		
		$pic->advid = $maxidd;				
		//$pic -> save();
		
		//return redirect('/imageupload/'.$maxidd);
		return $this->imageindex($maxidd);
		//return Redirect::action('UserController@profile', array('user' => 1));
	}
	public function imageindex($advid)
	{
		
		//$advid = $this->advid;
		//$advid = $request->advid;
		
		//$images = Picture::find($advid);
		$images = DB::table('picture')
           		->rightjoin('adv', 'picture.advid', '=', 'adv.id')
            		->select('picture.advid','picture.path', 'adv.advtopic', 'adv.id', 'picture.id as picid')
            		->where('adv.id', $advid)
            		->get();
		
		return view('bssr.imageupload',compact('images'));
	
	}
		
	public function imageupload(Request $request)
	{
		$this->validate($request, [
		
		    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
		
		]);
		
		
		$input['path'] = time().'.'.$request->image->getClientOriginalExtension();
		
		$request->image->move(public_path('avatar'), $input['path']);
				 
		//$img->resize(300, 200);
		
		$image = Image::make(sprintf('avatar/%s', $input['path']))->resize(null, 500, function($cnts){$cnts->aspectRatio();})->save();
		
		$advid = $request->advid;
		$addtitle = $request->adtitle;
		$input['advid'] = $advid;
		
		Picture::create($input);
		
		//return back()->with('advid', $advid)->with('addtitle', $addtitle);
		return $this->imageindex($advid);
	
	}

	public function imagedestroy($id)
	{
		$inputs = Input::all();
		$advid=$inputs['advid'];
		
		
		$img = Picture::find($id);
		
		$image_path = public_path("avatar/".$img->path);

		if (File::exists($image_path)) {
			//File::delete($image_path);
			unlink($image_path);
		 }
		 $img->delete();
			//return back() ->with('success','Image removed successfully.');	
		return $this->imageindex($advid);
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
		
		    $message->from('noreply@gmail.com', 'BSSR Administration');
		
		    $message->to($email_to);
				
		    $message->subject("BSSR Mail Notification");
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
	public function categoryview($catid)
	{
		$bssr = Bssr::leftjoin('place', 'adv.placeid', '=', 'place.id') 
			->leftjoin('category', 'adv.categoryid', '=', 'category.id')
			->leftjoin('picture', 'picture.advid', '=', 'adv.id')
            		->select('adv.*', 'picture.path as path', 'place.placename as placename', 'category.categoryname as categoryname')
            		->where('category.categoryname', 'like', '%'.$catid.'%')
            		->groupBy('adv.id')
            		//->groupBy('adv.id')
            		->orderby('adv.created_at', 'DESC')
            		->paginate(20);
            		            		
		return view('bssr.category')->with('bssr', $bssr);
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
	
	public function angular($id = null) {
		
	if ($id == null) {
            return Bssr::orderBy('id', 'asc')->get();
            //return view('bssr.angular', compact('bssr'));
        } else {
            return $this->bssr($id);
        }
        
    }

}
