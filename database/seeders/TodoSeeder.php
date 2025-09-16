<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;
use Carbon\Carbon;


class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Todo::insert([
            [
                'title'       => 'Belajar Laravel',
                
                'status'      => 'pending',
                'priority'    => 'high',
                'assignee'    => 'Saul',
                'time_tracked'=> 50,
                'due_date'    => now()->addDays(2),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Buat API Todo',
                'status'      => 'open',
                'priority'    => 'high',
                'assignee'    => 'Saul',
                'time_tracked'=> 30,
                'due_date'    => now()->addDays(5),
                'created_at'  => now()->subDay(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Testing Export',
                
                'status'      => 'completed',
                'priority'    => 'low',
                'assignee'    => 'Andi',
                'time_tracked'=> 10,
                'due_date'    => now()->subDay(),
                'created_at'  => now()->subDays(3),
                'updated_at'  => now(),
            ],
        ]);

        // Tambahkan data dummy (20 data random)
        Todo::factory()->count(20)->create();
    }
}
