<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaction_types')->insert([
           ['name'=>'MerchantFees'],
           ['name'=>'servicesFees'],
           ['name'=>'PaymentTaxes'],
           ['name'=>'DeliveryFees'],
        ]);
    }
}
