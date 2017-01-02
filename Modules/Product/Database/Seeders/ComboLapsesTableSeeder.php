<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-14 11:35:53
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-02 10:06:19
 */


namespace Modules\Product\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use Modules\Product\Entities\ComboLapse;
use Modules\Product\Repositories\ComboRepository;

/**
 * Class of type Seeder by table Combo lapse
 * @author Francisco Mendoza
 */
class ComboLapsesTableSeeder extends Seeder
{

  /**
   * protected class variable
   *
   * @var comboRepo    - combo repository conection BD
  **/
  protected $comboRepo;

  /**
   * construct function - constructor of the class
   *
   * @param  ComboRepository comboRepo injection of dependency
   * @return void
   * @author Francisco Mendoza
   **/
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
      $date = date('Y-m-d'); 
      ComboLapse::create([
        'id' => $faker->uuid,
        'date_start' => $date,
        'date_end' => $faker->dateTimeBetween($date, '+10 days',date_default_timezone_get())->format('Y-m-d'),
        'combo_id' => $value->id,
      ]);
    }
  }
}
