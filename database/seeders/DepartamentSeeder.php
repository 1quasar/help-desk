<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departament::updateOrCreate(
            [
                'name' => 'Suporte',
                'code' => 'TI',
            ]
        );

        Departament::updateOrCreate(
            [
                'name' => 'Recursos Humanos',
                'code' => 'RH',
            ]
        );

        Departament::updateOrCreate(
            [
                'name' => 'Financeiro',
                'code' => 'FIN',
            ]
        );

        Departament::updateOrCreate(
            [
                'name' => 'Infraestrutura',
                'code' => 'INFRA',
            ]
        );
    }
}
