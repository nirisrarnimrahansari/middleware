<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Illuminate\Support\Facades\URL;
 
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }
    public function login()
    {
        // echo URL::current();
        // echo url()->previous();
        // echo url()->full();
        return view('login');
    }
    public function showas()
    {
        return view('demo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if(session::has('loginId')){
            session::pull('loginId');
            return redirect('login');
        }
        return redirect('login');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'email address',
            'role' => 'required',
            'password' => 'required'
        ]);
        // $path = $request->photo->storeAs('images', 'filename.jpg');

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $status = User::create($data);
        if($status){
            request()->session()->flash('success', 'Data Created SuccessFully !');
        }else{
            request()->session()->flash('error', 'Data Not Created !');
        }
        return redirect()->back();
    }

    public function loginUser(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        // "id" => 5 "name" => "admin" "email" => "admin@gmail.com" "role" => "admin" "email_verified_at" => null  "password" => "$2y$10$.k0EbsJWUkrPxwZTxE8zvuJvQNnue/DTa4R/vFxnnk3WQfYdHdVjO"  "remember_token" => null  "created_at" => "2023-03-15 17:43:57"  "updated_at" => "2023-03-15 17:43:57"
        if($user){
            if(Hash::check($request->password, $user->password) && $request->role == 'admin'){
                $request->session()->put('loginId', $user->id);
                $request->session()->put('loginRole', $user->role);
                 print_r(session::has('loginId')); 

                return redirect('dashboard');
                 print_r(session::has('loginId')); 

            }elseif(Hash::check($request->password, $user->password) && $request->role == 'user'){
                $request->session()->put('loginId', $user->id);
                $request->session()->put('loginRole', $user->role);
                return redirect('userDashboard');
            }else{
                return back()->with('fail', 'This Password is not matched');
            }
        }else{
            return back()->with('fail', 'This Email ID is not matched');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $users = User::all();
        $data = array();
        if(session::has('loginId') ) {
            $data = User::where('id','=', session::get('loginId'))->first();
            if(session()->has('loginRole') =='admin'){
                return view('dashboard')->with('data', $data)->with('users', $users);
            }else{
                return redirect()->back();
            }
        }
    }
    public function userDashboard()
    {
        $users = User::all();
        $data = array();
        if(session::has('loginId') && session()->has('loginRole') == 'user') {
            $data = User::where('id','=', session::get('loginId'))->first();
                return view('userDashboard')->with('data', $data)->with('users', $users);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $userid = $request->user_id;
        // dd($userid);
        $searchTerms = explode(' ', $userid);
        $query = User::query();
        foreach($searchTerms as $searchTerm){
            $query->where(function($q) use ($searchTerm){
                $q->where('id', 'like', '%'.$searchTerm.'%')
                ->orWhere('name', 'like', '%'.$searchTerm.'%')
                ->orWhere('email', 'like', '%'.$searchTerm.'%')
                ->orWhere('role', 'like', '%'.$searchTerm.'%');
            });
        }
        $response['data'] = $query->get();
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

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
