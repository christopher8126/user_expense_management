<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_expense['user'] = User::role('user')->get();
        $user_expense['expense'] = DB::table('expenses')->select('category_id', DB::raw('SUM(cost) as total_expense'))->groupBy('category_id')->get();

        return User::role('user')->get();

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
        // dd($request->all());
        $new_user = new User;
        $new_user->email = $request->email;
        $new_user->first_name = $request->first_name;
        $new_user->last_name = $request->last_name;
        $new_user->password = Hash::make($request->password);
        $new_user->assignRole('user');
        $new_user->save();

        return $new_user;
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
        return User::find($id);
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

        $update_user = User::find($id);
        $update_user->email = $request->email;
        $update_user->first_name = $request->first_name;
        $update_user->last_name = $request->last_name;

        if(isset($request->password)){

            $update_user->password = Hash::make($request->password);

        }

        $update_user->save();

        return $update_user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_user = User::find($id);
        $delete_user->delete();

        return $delete_user;
    }

    public function changePassword(Request $request){

        $update_password = User::find($request->user_id);
        $update_password->password = Hash::make($request->password);
        $update_password->save();

        return $update_password;

    }
}
