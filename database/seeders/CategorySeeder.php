<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=['Action','Drama','Horror','Comedy','Romance','Sci-Fi','Documentary','Thriller','Animation','Adventure'];
        foreach($data as $d){
            Category::create([
                'slug'=>Str::slug($d),
                'name'=>$d,
            ]);
        }
//  'slug'=>strtolower(str_replace(' ','-',$d))


        // $categories=['Action','Drama','Horror','Comedy','Romance'];
        // foreach($categories as $category){
        //     $data[]=[
        //         'name'=>$category,
        //         'slug'=>strtolower($category),
        //     ];

        // Category::create(['name'=>'Action','slug'=>'action']);
        // Category::create(['name'=>'Drama','slug'=>'drama']);
        // Category::create(['name'=>'Horror','slug'=>'horror']);
        // Category::create(['name'=>'Comedy','slug'=>'comedy']);
        // Category::create(['name'=>'Romance','slug'=>'romance']);
    }
}
