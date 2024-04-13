<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    public function index(){
        $task_list = Task::paginate(5);
         return view('index',compact('task_list'));
    }
    public function store(Request $request){
        $request->validate([
            'title'=> 'required|min:3',
            'description'=> 'required|min:5',
        ]);

        $result = Task::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'status'=> 1,
            ]);

        if($result){
            Alert::success('Success', 'Successfully Task Added!');
        }else{
            Alert::error('error', 'Something went wrong!');
        }
        return redirect()->route('index');
   }
   public function delete($id){
        $data = Task::find($id);
        if($data){
            $data->delete();
            Alert::success('Success','Successfully task deleted!');
        }else{
            Alert::error('error','Data not found!');
        }
        return redirect()->route('index');
   }
   public function edit($id){
        $single_data = Task::findOrFail($id);
        if($single_data){
            $task_list = Task::paginate(5);
            return view('index',compact('single_data','task_list'));
        }else{
            Alert::error('Error','Data not Found!');
            return redirect()->route('index');
        }
   }

   public function update(Request $request, $id){
        $result = Task::find($id)->update([
            'title'=> $request->title,
            'description'=> $request->description
            ]);
        if($result){
            Alert::success('Success','Successfully updated');
        }else{
            Alert::error('Error','Data is not Existed!');
        }
        return redirect()->route('index');
   }


   public function register(){
        return view('register');
   }
   public function userStore(Request $request){
         $request->validate([
            'name'=>'required',
            'email'=> 'required|email',
            'password'=> 'required'
         ]);
         $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
            ]);
        if($user){
            Alert::success('Success', 'Successfully user Added!');
        }else{
            Alert::error('error', 'Something went wrong!');
        }
        return redirect()->back();
   }
   public function login(){
        return view('login');
   }

   public function userLogin(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
              Alert::success('Success','Successfully login');
              return redirect()->route('dashboard');
        }else{
            Alert::error('Error','Incurrect login credentials');
        }
        return redirect()->back();
   }

   public function dashboard(){
        return view('dashboard');
   }

   public function logout(){
        Auth::logout();
        Alert::success('Success','logout successfully');
        return redirect()->route('login');
   }

   public function is_active(Request $request, $id)
   {
       $data = Task::find($id)->status;
       if ($data == 1) {
           $update = Task::find($id)->update([
               'status' => 0
           ]);
       } else {
           $update = Task::find($id)->update([
               'status' => 1
           ]);
       }
       return redirect()->back()->with('success', 'Status Updated Successfully');
   }
}
