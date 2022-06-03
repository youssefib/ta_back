<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'first_name' => 'youssef',
        //     'last_name' => 'ibaichou',
        //     'username' => 'ucef',
        //     'email' => 'youssef@app.com',
        //     'password' => bcrypt('youssef'),
        // ]);

        // \App\Models\User::create([
        //     'first_name' => 'f_user1',
        //     'last_name' => 'l_user1',
        //     'username' => 'u_user1',
        //     'email' => 'e_user1@app.com',
        //     'password' => bcrypt('user1'),
        // ]);

        // \App\Models\User::create([
        //     'first_name' => 'f_user2',
        //     'last_name' => 'l_user2',
        //     'username' => 'u_user2',
        //     'email' => 'e_user2@app.com',
        //     'password' => bcrypt('user2'),
        // ]);

        // \App\Models\User::create([
        //     'first_name' => 'f_user3',
        //     'last_name' => 'l_user3',
        //     'username' => 'u_user3',
        //     'email' => 'e_user3@app.com',
        //     'password' => bcrypt('user3'),
        // ]);

        // \App\Models\User::create([
        //     'first_name' => 'f_user4',
        //     'last_name' => 'l_user4',
        //     'username' => 'u_user4',
        //     'email' => 'e_user4@app.com',
        //     'password' => bcrypt('user4'),
        // ]);

        // \App\Models\User::create([
        //     'first_name' => 'f_user5',
        //     'last_name' => 'l_user5',
        //     'username' => 'u_user5',
        //     'email' => 'e_user5@app.com',
        //     'password' => bcrypt('user5'),
        // ]);

        // \App\Models\Vehicule::create([
        //     'immat' => '001',
        //     'taux_km' => '10',
        // ]);

        // \App\Models\Vehicule::create([
        //     'immat' => '002',
        //     'taux_km' => '17',
        // ]);

        // \App\Models\Vehicule::create([
        //     'immat' => '003',
        //     'taux_km' => '20',
        // ]);

        // \App\Models\Vehicule::create([
        //     'immat' => 'S004',
        //     'taux_km' => null,
        // ]);


        \App\Models\Deplacement::create([
            "user_id"       =>'1',
            "vehicule_id"   =>'11',
            "date"          =>'2022-05-15 14:56:44',
            "intitule"      =>'test',
            "peage"         =>'50',
            "ptm"           =>'20',
            "nb_km"         =>'30',
            "t_km"         =>'1.2',
            "f_divers"      =>0,
            "m_divers"      =>null,
            "infos"         =>null,
            "t_repas"       =>'type 1',
            "nb_repas"      =>'3',
            "m_repas"       =>'500',
            "m_hotel"       =>'30',
            "valider"       => 0,
            "imprime"       => 0,
            "d_imp"         =>null,
        ]);

        \App\Models\Deplacement::create([
            "user_id"       =>'1',
            "vehicule_id"   =>'11',
            "date"          =>'2022-05-15 14:56:44',
            "intitule"      =>'test 1',
            "peage"         =>'50',
            "ptm"           =>'20',
            "nb_km"         =>'30',
            "t_km"         =>'1.2',
            "f_divers"      =>0,
            "m_divers"      =>null,
            "infos"         =>null,
            "t_repas"       =>'type 1',
            "nb_repas"      =>'3',
            "m_repas"       =>'500',
            "m_hotel"       =>'30',
            "valider"       => 0,
            "imprime"       => 0,
            "d_imp"         =>null,
        ]);

        \App\Models\Deplacement::create([
            "user_id"       =>'2',
            "vehicule_id"   =>'12',
            "date"          =>'2022-05-15 14:56:44',
            "intitule"      =>'test 2',
            "peage"         =>'505',
            "ptm"           =>'201',
            "nb_km"         =>'308',
            "t_km"         =>'1.2',
            "f_divers"      =>0,
            "m_divers"      =>null,
            "infos"         =>null,
            "t_repas"       =>'type 1',
            "nb_repas"      =>'3',
            "m_repas"       =>'500',
            "m_hotel"       =>'30',
            "valider"       => 0,
            "imprime"       => 0,
            "d_imp"         =>null,
        ]);

        \App\Models\Deplacement::create([
            "user_id"       =>'3',
            "vehicule_id"   =>'13',
            "date"          =>'2022-05-15 14:56:44',
            "intitule"      =>'test 3',
            "peage"         =>'501',
            "ptm"           =>'220',
            "nb_km"         =>'380',
            "t_km"         =>'1.5',
            "f_divers"      =>0,
            "m_divers"      =>null,
            "infos"         =>null,
            "t_repas"       =>'type 2',
            "nb_repas"      =>'3',
            "m_repas"       =>'500',
            "m_hotel"       =>'30',
            "valider"       => 0,
            "imprime"       => 0,
            "d_imp"         =>null,
        ]);


    }
}
