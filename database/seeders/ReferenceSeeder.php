<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Reference;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            
            [
                'code' => 'CATEGORY', 
                'item' => 'Pilih Category Layanan',
                'value' => 'Instalasi',
                'sort' => 1
            ],
            [
                'code' => 'CATEGORY', 
                'item' => 'Pilih Category Layanan',
                'value' => 'Reset Password',
                'sort' => 2
            ],
            [
                'code' => 'CATEGORY', 
                'item' => 'Pilih Category Layanan',
                'value' => 'Jaringan',
                'sort' => 3
            ],
        ];

        foreach($reference as $ref ){
            $x = new Reference();
            $x->fill($ref);
            $x->save();
        }
    }
}
