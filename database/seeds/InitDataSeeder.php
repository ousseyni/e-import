<?php

use App\Contribuables;
use App\Pays;
use App\Profils;
use App\TypeContribuables;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profils::create([
            'libelle'     => 'Administrateur',
        ]);

        Profils::create([
            'libelle'     => 'Usager',
        ]);

        User::create([
            'name' => 'Admin DGCC',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'email_verified' => 1,
            'email_verification_token' => '',
            'login' => 'admin',
            'profilid' => 1,
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Usager DGCC',
            'email' => 'usager@gmail.com',
            'email_verified_at' => Carbon::now(),
            'email_verified' => 1,
            'email_verification_token' => '',
            'login' => '070199-F',
            'profilid' => 2,
            'password' => bcrypt('070199-F'),
        ]);

        TypeContribuables::create([
            'libelle'     => 'Importateur',
        ]);

        TypeContribuables::create([
            'libelle'     => 'Exportateur',
        ]);

        TypeContribuables::create([
            'libelle'     => 'Producteur Local',
        ]);

        $file = public_path('init_files/contribuables.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added
                Contribuables::updateOrCreate(
                    ['nif' => $data[0]],
                    [
                        'raisonsociale' => $data[1],
                        'nomprenom' => addslashes($data[2]),
                    ]
                );
            }
        }
        fclose($handle);


        $file = public_path('init_files/pays.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                Pays::create([
                    'libelle'     => addslashes($data[1]),
                ]);
            }
        }
        fclose($handle);
    }
}
