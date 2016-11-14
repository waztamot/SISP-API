<?php

namespace Modules\Product\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use Modules\Product\Entities\ComboLapse;
use Modules\Product\Repositories\ComboRepository;

class ComboLapsesTableSeeder extends Seeder
{

  protected $comboRepo;

  public function __construct(ComboRepository $comboRepo) 
  {
      $this->comboRepo = $comboRepo;
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create('es_VE');

    $combos = $this->comboRepo->allActive();

    foreach ($combos as $key => $value) {
      $date = $faker->dateTimeBetween('now', '+10 days',date_default_timezone_get());
      ComboLapse::create([
        'id' => $faker->uuid,
        'date_start' => $date,
        'date_end' => $faker->dateTimeBetween($date, '+10 days',date_default_timezone_get()),
        'combo_id' => $value->id,
      ]);
    }
  }
}
