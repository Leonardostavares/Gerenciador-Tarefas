<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
    public function run(): void
    {
        $categories = [
            ['name' => 'Trabalho', 'description' => 'Tarefas relacionadas ao trabalho.'],
            ['name' => 'Pessoal', 'description' => 'Tarefas pessoais e compromissos.'],
            ['name' => 'Estudos', 'description' => 'Atividades acadêmicas e de aprendizado.'],
            ['name' => 'Lazer', 'description' => 'Atividades de lazer e hobbies.'],
        ];
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
    