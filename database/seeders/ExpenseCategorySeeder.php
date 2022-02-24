<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $category_expense = [
            'Electric Bill',
            'Water Bill',
            'Personal Expenses'
        ];

        foreach ($category_expense as $key => $value) {

            DB::table('expense_categories')->insert([

                'category_name' => $value
    
            ]);

        }
        
    }
}
