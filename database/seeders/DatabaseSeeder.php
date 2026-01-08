<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@test.com',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::factory()->create([
            'name' => 'User 2',
            'email' => 'user2@test.com',
            'password' => Hash::make('password'),
        ]);

        $leadsUser1 = Lead::factory()
            ->count(10)
            ->create(['assigned_to' => $user1->id]);

        $leadsUser2 = Lead::factory()
            ->count(10)
            ->create(['assigned_to' => $user2->id]);

        $mergeLeads = $leadsUser1->merge($leadsUser2)->shuffle();

        Task::factory()
            ->count(15)
            ->make()
            ->each(function ($task) use ($mergeLeads) {
                $task->lead_id = $mergeLeads->random()->id;
                $task->save();
            });
    }
}
