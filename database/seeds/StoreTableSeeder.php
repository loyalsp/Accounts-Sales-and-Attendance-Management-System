<?php

use Illuminate\Database\Seeder;
use App\Store;
class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = new Store();
        $store->store_name = "Sargodha Branch";
        $store->location = "PAF Road SGD";
        $store->save();

        $store1= new Store();
        $store1->store_name = "Lahore Branch";
        $store1->location = "Mall Road LHR";
        $store1->save();

        $store2 = new Store();
        $store2->store_name = "Islamabad branch";
        $store2->location = "G/10-ISB";
        $store2->save();

        $store3 = new Store();
        $store3->store_name = "Karachi Branch";
        $store3->location = "KHI";
        $store3->save();

    }
}
