<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        // return view("data_user", compact("users"));  
        return response()->json(
            [
                'message' => "Berhasil Menambah Data User",
                'status' => 200,
                'data' => $users
            ]
        );
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
        $checkusername = User::withTrashed()->first();
        if($request->username == $checkusername)
        {
            return redirect()->back()->with('status', 'username sudah digunakan');
        }
        else
        {
            $name = $request->name;
            $username = $request->username;
            $password = Hash::make($request->password);
            $role     = $request->role;

            User::create([
                "name" => $name,
                "username" => $username,
                "password" => $password,
                "role" => $role
            ]);
            return redirect()->back()->with('status', 'Berhasil Menambah User');
        }
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
        $take_users = User::where('id', $id);

        return view("data_user", compact("take_users"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, string $user)
    {
        $checkUsername = User::withTrashed()->where('username', $request->username)->first();
        if($checkUsername && $request->username != User::find($user)->username){
            return redirect()->back()->with('status', 'Username Sudah Digunakan');
        }
        else{
            if($request->confirm_password == $request->password)
            {
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'role' => $request->role,
                ];
    
                if($request->password != "")
                {
                    $data['password'] = Hash::make($request->password);
                }
                $user = User::find($user)->update($data);
                if($user){
                    return redirect()->back()->with('status', 'Berhasil Mengedit User');
                }
            }
            return redirect()->back()->with('status','Gagal Mengedit Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::find($id)->delete();
        if ($delete)
        {
            return redirect('/data_user')->with('status', 'Berhasil menghapus user');
        }
        else
        {
            return redirect('/data_user')->with('status','Gagal menghapus user');
        }
    }
}
