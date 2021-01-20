<?php

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
        $this->call(PermissionsTableSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(CoordinationSeeder::class);
        $this->call(RequisitionSeeder::class);
        $this->call(QuotesrequisitionsSeeder::class);
        $this->call(ProvidersSeeder::class);
        $this->call(PurchaseSeeder::class);
        $this->call(StorehouseSeeder::class);
    }
}
