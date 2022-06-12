<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Redaction as ModelsRedaction;
use App\Models\User;
use App\Models\Teacher as ModelsTeacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SocialMedia::factory(5)->create();
        \App\Models\Tag::factory(5)->create();
        \App\Models\Log::factory(5)->create();
        foreach (ModelsRedaction::all() as $redaction) {
            $redaction->tags()->attach(rand(1,3));
            $redaction->tags()->attach(rand(4,5));
            $redaction->illustrators()->attach(rand(1,3));
            $redaction->illustrators()->attach(rand(4,5));
        }
        foreach (ModelsTeacher::all() as $teacher) {
            $teacher->schools()->attach(rand(1,3));
            $teacher->schools()->attach(rand(4,5));
        }

        $user = User::create([
            'user_type' => 'Administrator',
            'email' => 'adm@super.com.br',
            'password' => Hash::make('adm@super.123'),
            'email_verified_at' => now(),
            'lastAccess' => now(),
            'remember_token' => Str::random(10),
        ]);
        $administrator = Administrator::create([
            'name' => 'Super Adiministrador',
            'cpf' => '12345678900',
            'birthday' => '2022-01-01',
            'state' => 'Brasil',
            'city' => 'Brasil',
        ]);
        $administrator->user_id = $user->id;
        $administrator->save();


    }
}
