<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reference;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'password' => bcrypt('password')
        ]);
        // $user->createToken('helpwa');

        $reference = [
            [
                'code' => 'pic', 
                'item' => 'PIC',
                'value' => 'PIC#MIDIN',
                'sort' => 1
            ],
            [
                'code' => 'end', 
                'item' => 'THX',
                'value' => 'THX',
                'sort' => 1
            ],
            [
                'code' => 'rate', 
                'item' => 'RATE',
                'value' => 'RATE',
                'sort' => 1
            ],
            [
                'code' => 'REPLY', 
                'item' => 'Ada yang bisa saya bantu?',
                'value' => 'Ada yang bisa saya bantu?',
                'sort' => 1
            ],
            [
                'code' => 'RATING', 
                'item' => 'Tolong Nilai Ya',
                'value' => 'Sangat Baik Sekali',
                'sort' => 1
            ],
            [
                'code' => 'RATING', 
                'item' => 'Tolong Nilai Ya',
                'value' => 'Cukup Baik',
                'sort' => 2
            ],
            [
                'code' => 'RATING', 
                'item' => 'Tolong Nilai Ya',
                'value' => 'Baik',
                'sort' => 3
            ],
            [
                'code' => 'RATING', 
                'item' => 'Tolong Nilai Ya',
                'value' => 'Kurang Baik',
                'sort' => 4
            ],
            [
                'code' => 'RATING', 
                'item' => 'Tolong Nilai Ya',
                'value' => 'Tidak Baik',
                'sort' => 5
            ],
        ];

        foreach($reference as $ref ){
            $x = new Reference();
            $x->fill($ref);
            $x->save();
        }
    }
}
