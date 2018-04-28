<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use Mail;

use Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:30',
            'password' => 'required|min:3|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
	// ----------------------------maillllllllll -----------------------------
	
	$mailcont = array('name'=>$data['name'], 'phone'=>$data['phone'], 'email'=>$data['email']);
	
	$email_to = $data['email'];

	Mail::send('emails.registration', $mailcont, function ($message) use ($email_to)
	{
	    $message->from('noreply@druklink.net', 'Rent Exchange Buy Sell Administration');
		
	    $message->to($email_to);
				
	    $message->subject("REBS Account Registration");
	});
	//------------------------- mail end---------------------------------

       $url  = session('backUrl');    
       $this->redirectTo = $url; 

       return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'usertype'=>2,
        ]);

    }
    
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try
        {
    	    $socialUser = Socialite::driver('facebook')->user();
    	}
    	catch(\Exception $e)
    	{
    		return redirect('/');
    	}

        //$url  = session('backUrl');    
        //$this->redirectTo = $url;
    	
    	$user = User::where('facebook_id', $socialUser->getId())->first();
    	if(!$user)
    		$user = User::create([
    			'facebook_id' => $socialUser->getId(),
    			'name' => $socialUser->getName(),
    			'email' => $socialUser->getEmail(),
    		]);
    	auth()->login($user);
    	//return redirect('/');
         
        return redirect()->intended('dashboard');

        //return $user -> getEmail();
        // $user->token;
    }           
}
