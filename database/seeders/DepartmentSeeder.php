<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::updateOrCreate(
            [
                'name' => 'Suporte',
                'code' => 'TI',
            ]
        );

        Department::updateOrCreate(
            [
                'name' => 'Recursos Humanos',
                'code' => 'RH',
            ]
        );

        Department::updateOrCreate(
            [
                'name' => 'Financeiro',
                'code' => 'FIN',
            ]
        );

        Department::updateOrCreate(
            [
                'name' => 'Infraestrutura',
                'code' => 'INFRA',
            ]
        );
    }
}
