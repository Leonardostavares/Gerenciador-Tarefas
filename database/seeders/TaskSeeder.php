<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        // BUSCA REAL: Pega apenas os IDs que realmente existem nas tabelas
        $userIds = DB::table('users')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        // SEGURANÇA: Se não houver usuários ou categorias, para o seeder com um aviso
        if (empty($userIds) || empty($categoryIds)) {
            $this->command->error('ERRO: Você precisa ter usuários e categorias cadastrados antes de rodar este Seeder!');
            return;
        }

        $this->command->info('Limpando a tabela de tarefas...');
        DB::table('tasks')->truncate();

        $this->command->info('Criando 500 tarefas com IDs validados...');

        foreach (range(1, 500) as $index) {
            $createdAt = Carbon::now()->subDays(rand(1, 180));
            $isFinished = rand(1, 100) <= 80;
            $finishedAt = $isFinished 
                ? (clone $createdAt)->addDays(rand(1, 15))->addHours(rand(1, 23))
                : null;
            $status = $finishedAt ? 'concluída' : 'pendente';

            try {
                DB::table('tasks')->insert([
                    'title'       => $faker->sentence(3),
                    // randomElement agora pega um ID que EXISTE de fato no array
                    'user_id'     => $faker->randomElement($userIds),
                    'category_id' => $faker->randomElement($categoryIds),
                    'created_at'  => $createdAt,
                    'updated_at'  => Carbon::now(),
                    'finished_at' => $finishedAt,
                    'status'      => $status,
                ]);
            } catch (\Exception $e) {
                $this->command->error("Erro na tarefa $index: " . $e->getMessage());
                return;
            }
        }
        $this->command->info('Sucesso! 500 tarefas inseridas sem erros de integridade.');
    }
}