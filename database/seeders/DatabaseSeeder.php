<?php

namespace Database\Seeders;

use App\Models\Configuracion\Connection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $stores = array('online', 'asambi', 'cande', 'ccct', 'casca', 'hatilo', 'lider', 'recreo');

        $shop = Str::lower(config('app.almacen'));

        if ($shop == 'matriz') {
            foreach ($stores as $value) {
                Connection::create(array(
                    'shop' => $value,
                    'status' => '0',
                    'start_date' => now(),
                ));
            }
        } else {
            Connection::create(array(
                'shop' => $shop,
                'status' => '0',
                'start_date' => now(),
            ));
        }
    }
}
