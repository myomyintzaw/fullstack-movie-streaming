<?php

namespace Database\Seeders;

use App\Models\Sub;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'slug'=>'30-day',
                'name'=>'Small Plan',
                'price'=>'5000',
                'total-day'=>'30',
            ],
            [
                'slug'=>'60-day',
                'name'=>'Medium Plan',
                'price'=>'10000',
                'total-day'=>'60',
            ],
            [
                'slug'=>'90-day',
                'name'=>'Mega Plan',
                'price'=>'14000',
                'total-day'=>'90',
            ],
        ];
        // \App\Models\Sub::insert($data);
        foreach($data as $item){
            Sub::create([
                'slug'=>$item['slug'],
                'name'=>$item['name'],
                'price'=>$item['price'],
                'total-day'=>$item['total-day'],
            ]);

        }
    }
}
