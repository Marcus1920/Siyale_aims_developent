<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\PoiPictureType;

class PoiPicturesTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('poi_pictures_types')->delete();
        PoiPictureType::create(['id' => '1','name' => 'profile']);
        PoiPictureType::create(['id' => '2','name' => 'tattoo']);
        PoiPictureType::create(['id' => '3','name' => 'scar']);
        PoiPictureType::create(['id' => '4','name' => 'id']);
        PoiPictureType::create(['id' => '5','name' => 'vehicle']);


    }
}



