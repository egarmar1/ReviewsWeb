<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
class UserController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    public function index($id) {
        $user = User::find($id);
        

        return view('user.profile', [
            'user' => $user,
        ]);
    }

    public function getImage($file) {
        $image = Storage::disk('users')->get($file);
        $response = new Response($image, 200);
        $response->header('Content-Type', 'image/jpeg');
        return $response;
    }
    
    public function settings(){
        $user= \Auth::user();
        return view('user.settings', ['user' => $user]);
    }
    
    public function update(Request $request){
        $user = \Auth::user();
        $id = $user->id;
        
        $validate = $this->validate($request, [
            'nick' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);
        
        
        $nick = $request->input('nick');
        $email = $request->input('email');
        $image = $request->file('image');
        
        $user->nick = $nick;
        $user->email = $email;
        
        if($image){
            $image_path = time().$image->getClientOriginalName();
            Storage::disk('users')->put($image_path, File::get($image));
            
            $user->image = $image_path;
        }
        
        $user->update();
        
        return redirect()->route('user.profile', ['id' => $id])
                         -> with(['message' => 'Profile changed']);
    }

}
