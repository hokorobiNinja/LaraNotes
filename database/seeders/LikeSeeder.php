<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Note;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.n
     */
    public function run(): void
    {
        $userIds = User::pluck('id');
        $noteIds = Note::pluck('id');

        $likesToCreate = 75;
        $createdCount = 0;

        $existingCombinations = [];

        while($createdCount < $likesToCreate) {
            $userId = $userIds->random();
            $noteId = $noteIds->random();

            if (isset($existingCombinations[$userId][$noteId])) {
                continue;
            }

            Like::create([
                'user_id' => $userId,
                'note_id' => $noteId,
            ]);

            $existingCombinations[$userId][$noteId] = 'created';
            $createdCount++;
        }
    }
}
