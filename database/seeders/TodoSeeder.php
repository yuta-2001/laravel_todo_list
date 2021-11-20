<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'title' => 'おつかい',
            'body' => '人参と白菜',
            'deadline' => '19801212',
            'created_at' => '20201212'
        ]);
    }
}
