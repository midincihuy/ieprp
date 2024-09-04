<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Reference;

class PasswordWifiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ref = Reference::create([
            'code' => "password_wifi",
            'item' => "Login Access EMTEK-GROUP-GUEST",
            'value' => "Silahkan gunakan password berikut : \n
- password123 \n
- tambah password\n
- password321",
        ]);
    }
}
