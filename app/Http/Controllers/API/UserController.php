<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(5);
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
             'name'=>'required|String|max:255',
             'email'=>'required|String|email|max:255|unique:users',
             'password'=>'required|String|min:6'

         ]);
        return User::create([
                   'name'=>$request['name'],
                   'email'=>$request['email'],
                   'password'=>Hash::make($request['password'])
        ]);
    }

    public function search()
    {
        if($search=\Request::get('q'))
        {
            $user=User::where(function($query) use ($search){
                $query->Where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%");
            })->paginate(3);
        }else{
            $user=User::latest()->paginate(4);
        }
        return $user;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return auth('api')->user();
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
        $user=User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|String|max:255',
            'email'=>'required|String|email|max:255|unique:users,email,'.$user->id,
            'password'=>'sometimes|String|min:6'

        ]);
        $user->update($request->all());
        return ['Message'=>'Updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user=User::findOrFail($id);
       $user->delete();
       return ['Message'=>'user deleted successfully'];
    }
}
