<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
             \App\Models\User::factory(10)->create(); //يجب بذر 10 مستخدمين قبل بذر الدروس 
            $this->call(UserSeeder::class);
            $this->call(LessonSeeder::class);  // وكل درس له مستخدم من 1 إلى 10
            $this->call(TagSeeder::class); //  Tags بذر 
            $this->call(LessonTagSeeder::class);  //    LessonTag بذر العلاقات   }
}
}