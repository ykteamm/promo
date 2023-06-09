<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\PriceMedicine;
use App\Models\PriceShablon;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

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

        // $category = ['Origins','Soft','Boost','Choy'];

        // foreach($category as $cate)
        // {
        //     $new_cat = new MedicineCategory([
        //         'name' => $cate,
        //     ]);
        //     $new_cat->save();
        // }

        // $new_cat = new PriceShablon([
        //     'name' => 'Noyabr narxlar',
        //     'active' => 1,
        // ]);
        // $new_cat->save();

        // $med_arr = ['Antigelmint  № 80 blister',
        //         'Antigelmint  № 110 BABY',
        //         'Antigelmint  № 40 kapsula',
        //         'Gepanorm  № 80 blister',
        //         'Gepanorm  № 40 kapsula',
        //         'Aktios  № 80 blister',
        //         'Bionoks  № 80',
        //         'Vitaderm  flakon 230 ml',
        //         'Vitaderm  flakon 110 ml',
        //         'Lagoxin  № 80 blister',
        //         'Vitaderm baby krem 75 ml',
        //         'Vitaderm lady krem',
        //         'Ekviliks  № 80',
        //         'Solegon  № 80 blister',
        //         'Solegon  № 40 kapsula',
        //         'Glustab №60 kapsula',
        //         'Immuno Kompleks',
        //         'Vitamin Calsiy + D3',
        //         'Multivitamin  N10',
        //         'Multivitamin  N40',
        //         'Askorbinka № 8',
        //         'Antigelmint gummy',
        //         'Bionoks gummy',
        //         'Ekviliks gummy',
        //         'Qora sedana yog\'i',
        //         'Oblepixa yog\'i',
        //         'Zig\'ir yog\'i',
        //         'Qovoq yog\'i',
        //         'Gelmintatsid',
        //         'Eurolabs Aminos',
        //         'Eurolabs Aminos ENERGY',
        //         'SlimFit DETOX',
        //         'SlimFit ENERGY',
        //         'Slim Fit 960 shokolad',
        //         'Slim Fit 960  klubnika',
        //         'Slim Fit 500  shokolad',
        //         'Slim Fit 500  klubnika',
        //         'Kaltsiy К2 Mumiyo',
        //         'Kurkuma',
        //         'Sleepboost',
        //         'Prostboost',
        //         'Biotin',
        //         'Energyboost',
        //         'Kaltsiy К2 Magniy',
        //         'Neyroboost',
        //         'Testoboost',
        //         'Endoboost',
        //         'Tinchlantiruvchi  choy',
        //         'Immuno  Choy',
        //         'Jigar  Choy',
        //         'Detox  Choy',
        //         'Yurak  Choy',
        //         'Qon Bosim  Choy',
        //         'Diabet  Choy',
        //         'Glintveyn  Choy',
        //         'Mevali  Choy',
        //         'Tropic Choy',
        //         'Oblepixa  Choy',
        //         'Buyrak  Choy',
        //         'Tomoq  Choy'];

        //         foreach($med_arr as $mr)
        //             {
        //                 $new_cat = new Medicine([
        //                     'name' => $mr,
        //                 ]);
        //                 $new_cat->save();
        //             }

        //         $prices = ['54000',
        //                 '59200',
        //                 '42000',
        //                 '51400',
        //                 '40800',
        //                 '58000',
        //                 '51400',
        //                 '40800',
        //                 '31200',
        //                 '59400',
        //                 '28800',
        //                 '31200',
        //                 '48750',
        //                 '51400',
        //                 '40800',
        //                 '46600',
        //                 '64800',
        //                 '54000',
        //                 '8400',
        //                 '54000',
        //                 '3120',
        //                 '48000',
        //                 '48000',
        //                 '48000',
        //                 '60000',
        //                 '42000',
        //                 '42000',
        //                 '42000',
        //                 '110000',
        //                 '45000',
        //                 '50000',
        //                 '110000',
        //                 '65000',
        //                 '506000',
        //                 '506000',
        //                 '275000',
        //                 '275000',
        //                 '110000',
        //                 '143000',
        //                 '84000',
        //                 '84000',
        //                 '84000',
        //                 '84000',
        //                 '84000',
        //                 '84000',
        //                 '84000',
        //                 '84000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000',
        //                 '24000'];

        //                 foreach($prices as $k => $pr)
        //             {
        //                 $new_cat = new PriceMedicine([
        //                     'medicine_id' => $k+1,
        //                     'price_shablon_id' => 1,
        //                     'price' => $pr,
        //                 ]);
        //                 $new_cat->save();
        //             }

                    // $regions = Http::get(getBattleUrl().'/api/region-district');

                    //     foreach ($regions as $key => $value) {

                    //         $region = new Region;
                    //         $region->name = $value[$key]['name'];
                    //         $region->side = $value[$key]['side'];
                    //         $region->save();

                    //         foreach ($value[$key]['district'] as $k => $v) {
                    //             $district = new District;
                    //             $district->name = $v[$k]['name'];
                    //             $district->region_id = $region->id;
                    //             $district->save();
                    //         }
                    //     }

                    $med_arr = [
                        'Suyak kompleksi',
                        'Ozish  kompleksi',
                        'Gijja  killer',
                        'Endokrin  kompleksi',
                        'Jigar va hazm  kompleksi',
                        ];

                foreach($med_arr as $mr)
                    {
                        $new_cat = new Medicine([
                            'name' => $mr,
                        ]);
                        $new_cat->save();
                    }

                        $prices = [
                                '304400',
                                '341000',
                                '212800',
                                '302400',
                                '260400',
                            ];

                        foreach($prices as $k => $pr)
                    {
                        $new_cat = new PriceMedicine([
                            'medicine_id' => $k+1+60,
                            'price_shablon_id' => 1,
                            'price' => $pr,
                        ]);
                        $new_cat->save();
                    }

    }
}
