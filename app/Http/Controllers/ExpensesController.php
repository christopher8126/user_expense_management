<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $new_expense = new Expense;
        $new_expense->user_id = $id;
        $new_expense->category_id = $request->categories_id;
        $new_expense->cost = $request->cost;
        $new_expense->save();

        return $new_expense;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $expenses = User::find($id);
        $expenses['expenses'] = Expense::where('user_id', $id)->with('category')->get();
        return $expenses;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $edit_expenses = Expense::where('id', $id)->with('category')->first();
        $edit_expenses['categories'] = ExpenseCategory::all();
        // $test = $edit_expenses->with('category')->get();
        return $edit_expenses;
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
        $update_expense = Expense::find($id);

        $update_expense->cost = $request->cost; 
        $update_expense->category_id = $request->category_id;
        $update_expense->save();
        
        return $update_expense;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete_expenses = Expense::find($id);
        $delete_expenses->delete();

        return $delete_expenses;

    }

    public function getExpenseCategory(){

        return ExpenseCategory::all();

    }

    public function saveCategory(Request $request){

        $saveCategory = new ExpenseCategory;

        $saveCategory->category_name = $request->category;
        $saveCategory->save();
        
        return $saveCategory;

    }

    public function getCategories(){
        $get_categories = DB::table('expenses')->select('category_id', DB::raw('SUM(cost) as total_expense'))->groupBy('category_id')->get();
        dd($get_categories);
        return ExpenseCategory::all();

    }

    public function getData(){

        return DB::table('expenses')->select('category_id', DB::raw('SUM(cost) as total_expense'))->groupBy('category_id')->get();

    }
}
