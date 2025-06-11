<?php

namespace Database\Seeders;

use App\Models\Order\Status;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Готовится'],
            ['name' => 'Готов'],
            ['name' => 'Отменен']
        ];

        Status::insert($statuses);
    }
}
