<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Position;
use App\Department;
use App\Province;
use App\District;
use App\Municipality;
use App\UserRole;
use App\Ward;
use App\Title;
use App\Language;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();

    # =========================================================================
    # ROLES SEEDS
    # =========================================================================


        DB::table('users_roles')->delete();

        $roles = [
                ['name' => 'Admin','slug' => 'Admin'],
                ['name' => 'Call Center Agent','slug'=>'Call_Center_Agent'],
                ['name' => 'Field Worker','slug' => 'Field_Worker']
        ];

        foreach ($roles as $role) {
            UserRole::create($role);
        }


    # =========================================================================
    # TITLES SEEDS
    # =========================================================================


        DB::table('titles')->delete();

        $titles = [
                ['name' => 'Mr','slug' => 'Mr'],
                ['name' => 'Mrs','slug'=>'Mrs'],
                ['name' => 'Miss','slug' => 'Miss'],
                ['name' => 'Ms','slug' => 'Ms']
        ];

        foreach ($titles as $title) {
            Title::create($title);
        }


    # =========================================================================
    # LANGUAGES SEEDS
    # =========================================================================


        DB::table('languages')->delete();

        $languages = [
                ['name' => 'English','slug' => 'EN'],
                ['name' => 'IsiZulu','slug'=>'Zulu'],
                ['name' => 'IsiXhosa','slug' => 'Xhosa']
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }




    # =========================================================================
    # USERS SEEDS
    # =========================================================================

        DB::table('users')->delete();

        User::create([

                        'name'      => 'Elie',
                        'surname'   => 'Ishimwe',
                        'email'     => 'elie@ubulwembu.net',
                        'password'  =>  bcrypt('198430'),
                        'cellphone' => '0829699114',
                        'role'      => 1
        ]);


    # =========================================================================
    # PROVINCES SEEDS
    # =========================================================================

         DB::table('provinces')->delete();
        $provinces = [

                        [
                            'name'          => 'KwaZulu-Natal',
                            'slug'          => 'KZN',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Gauteng',
                            'slug'          => 'GP',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Western Cape',
                            'slug'          => 'WC',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Eastern Cape',
                            'slug'          => 'EC',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Northern Cape',
                            'slug'          => 'NC',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'North West',
                            'slug'          => 'NW',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Free State',
                            'slug'          => 'FS',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Limpopo',
                            'slug'          => 'LP',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mpumalanga',
                            'slug'          => 'MP',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ]
            ];

        foreach ($provinces as $province) {
            Province::create($province);
        }



    # =========================================================================
    # DISTRICS SEEDS
    # =========================================================================



            DB::table('districts')->delete();
            $districts = [

                        [
                            'name'          => 'Ugu',
                            'slug'          => 'DC21',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umgungundlovu',
                            'slug'          => 'DC22',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Uthukela',
                            'slug'          => 'DC23',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umzinyathi',
                            'slug'          => 'DC24',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Amajuba',
                            'slug'          => 'DC25',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Zululand',
                            'slug'          => 'DC26',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umkhanyakude',
                            'slug'          => 'DC27',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Uthungulu',
                            'slug'          => 'DC28',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'iLembe',
                            'slug'          => 'DC29',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Harry Gwala',
                            'slug'          => 'DC43',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ethekweni',
                            'slug'          => 'ETH',
                            'province'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ]
            ];

            foreach ($districts as $district) {
                District::create($district);
            }



    # =========================================================================
    # MUNICIPALITIES SEEDS
    # =========================================================================

            DB::table('municipalities')->delete();
            $municipalities = [

                        [
                            'name'          => 'Vulamehlo',
                            'slug'          => 'KZN211',
                            'district'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umdoni',
                            'slug'          => 'KZN212',
                            'district'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umzumbe',
                            'slug'          => 'KZN213',
                            'district'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'UMuziwabantu',
                            'slug'          => 'KZN214',
                            'district'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ezinqoleni',
                            'slug'          => 'KZN215',
                            'district'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Hibiscus Coast',
                            'slug'          => 'KZN216',
                            'district'      => '1',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'uMshwathi',
                            'slug'          => 'KZN221',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'uMngeni',
                            'slug'          => 'KZN222',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mpofana',
                            'slug'          => 'KZN223',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Impendle',
                            'slug'          => 'KZN224',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Msunduzi',
                            'slug'          => 'KZN225',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mkhambathini',
                            'slug'          => 'KZN226',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Richmond',
                            'slug'          => 'KZN227',
                            'district'      => '2',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Emnambithi',
                            'slug'          => 'KZN232',
                            'district'      => '3',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Indaka',
                            'slug'          => 'KZN233',
                            'district'      => '3',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umtshezi',
                            'slug'          => 'KZN234',
                            'district'      => '3',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Okhahlamba',
                            'slug'          => 'KZN235',
                            'district'      => '3',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Imbabazane',
                            'slug'          => 'KZN236',
                            'district'      => '3',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Endumeni',
                            'slug'          => 'KZN241',
                            'district'      => '4',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Nquthu',
                            'slug'          => 'KZN242',
                            'district'      => '4',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Msinga',
                            'slug'          => 'KZN244',
                            'district'      => '4',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umvoti',
                            'slug'          => 'KZN245',
                            'district'      => '4',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Newcastle',
                            'slug'          => 'KZN252',
                            'district'      => '5',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Emadlangeni',
                            'slug'          => 'KZN253',
                            'district'      => '5',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Dannhauser',
                            'slug'          => 'KZN254',
                            'district'      => '5',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'eDumbe',
                            'slug'          => 'KZN261',
                            'district'      => '6',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'UPhongolo',
                            'slug'          => 'KZN262',
                            'district'      => '6',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Abaqulusi',
                            'slug'          => 'KZN263',
                            'district'      => '6',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Nongoma',
                            'slug'          => 'KZN265',
                            'district'      => '6',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ulundi',
                            'slug'          => 'KZN266',
                            'district'      => '6',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umhlabuyalingana',
                            'slug'          => 'KZN271',
                            'district'      => '7',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Jozini',
                            'slug'          => 'KZN272',
                            'district'      => '7',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'The Big 5 False Bay',
                            'slug'          => 'KZN273',
                            'district'      => '7',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Hlabisa',
                            'slug'          => 'KZN274',
                            'district'      => '7',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mtubatuba',
                            'slug'          => 'KZN275',
                            'district'      => '7',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mbonambi',
                            'slug'          => 'KZN281',
                            'district'      => '8',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'uMhlathuze',
                            'slug'          => 'KZN282',
                            'district'      => '8',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ntambanana',
                            'slug'          => 'KZN283',
                            'district'      => '8',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'uMlalazi',
                            'slug'          => 'KZN284',
                            'district'      => '8',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mthonjaneni',
                            'slug'          => 'KZN285',
                            'district'      => '8',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Nkandla',
                            'slug'          => 'KZN286',
                            'district'      => '8',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Mandeni',
                            'slug'          => 'KZN291',
                            'district'      => '9',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'KwaDukuza',
                            'slug'          => 'KZN292',
                            'district'      => '9',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ndwedwe',
                            'slug'          => 'KZN293',
                            'district'      => '9',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Maphumulo',
                            'slug'          => 'KZN294',
                            'district'      => '9',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ingwe',
                            'slug'          => 'KZN431',
                            'district'      => '10',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Kwa Sani',
                            'slug'          => 'KZN432',
                            'district'      => '10',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Greater Kokstad',
                            'slug'          => 'KZN433',
                            'district'      => '10',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Ubuhlebezwe',
                            'slug'          => 'KZN434',
                            'district'      => '10',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'Umzimkhulu',
                            'slug'          => 'KZN435',
                            'district'      => '10',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'West',
                            'slug'          => 'ETHW',
                            'district'      => '11',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'North Central',
                            'slug'          => 'ETHNC',
                            'district'      => '11',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'South Central',
                            'slug'          => 'ETHSC',
                            'district'      => '11',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'North',
                            'slug'          => 'ETHN',
                            'district'      => '11',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'name'          => 'South',
                            'slug'          => 'ETHS',
                            'district'      => '11',
                            'created_at'    =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
            ];



            foreach ($municipalities as $municipality) {
                Municipality::create($municipality);
            }


    # =========================================================================
    # RAP_WARDS SEEDS
    # =========================================================================

       DB::table('wards')->delete();
            $wards = [

                        [
                            'slug'              => '52101001',
                            'name'              => '1',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101002',
                            'name'              => '2',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101003',
                            'name'              => '3',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101004',
                            'name'              => '4',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101005',
                            'name'              => '5',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101006',
                            'name'              => '6',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101007',
                            'name'              => '7',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101008',
                            'name'              => '8',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101009',
                            'name'              => '9',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52101010',
                            'name'              => '10',
                            'municipality'      => '1',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52102001',
                            'name'              => '1',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102002',
                            'name'              => '2',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102003',
                            'name'              => '3',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102004',
                            'name'              => '4',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102005',
                            'name'              => '5',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102006',
                            'name'              => '6',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102007',
                            'name'              => '7',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102008',
                            'name'              => '8',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102009',
                            'name'              => '9',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52102010',
                            'name'              => '10',
                            'municipality'      => '2',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],



                        [
                            'slug'              => '52103001',
                            'name'              => '1',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103002',
                            'name'              => '2',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103003',
                            'name'              => '3',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103004',
                            'name'              => '4',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103005',
                            'name'              => '5',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103006',
                            'name'              => '6',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103007',
                            'name'              => '7',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103008',
                            'name'              => '8',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103009',
                            'name'              => '9',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103010',
                            'name'              => '10',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103011',
                            'name'              => '11',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103012',
                            'name'              => '12',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103013',
                            'name'              => '13',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103014',
                            'name'              => '14',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103015',
                            'name'              => '15',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103016',
                            'name'              => '16',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103017',
                            'name'              => '17',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103018',
                            'name'              => '18',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52103019',
                            'name'              => '19',
                            'municipality'      => '3',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52104001',
                            'name'              => '1',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104002',
                            'name'              => '2',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104003',
                            'name'              => '3',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104004',
                            'name'              => '4',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104005',
                            'name'              => '5',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104006',
                            'name'              => '6',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104007',
                            'name'              => '7',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104008',
                            'name'              => '8',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104009',
                            'name'              => '9',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52104010',
                            'name'              => '10',
                            'municipality'      => '4',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52105001',
                            'name'              => '1',
                            'municipality'      => '5',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52105002',
                            'name'              => '2',
                            'municipality'      => '5',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52105003',
                            'name'              => '3',
                            'municipality'      => '5',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52105004',
                            'name'              => '4',
                            'municipality'      => '5',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52105005',
                            'name'              => '5',
                            'municipality'      => '5',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52105006',
                            'name'              => '6',
                            'municipality'      => '5',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52106001',
                            'name'              => '1',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106002',
                            'name'              => '2',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106003',
                            'name'              => '3',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106004',
                            'name'              => '4',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106005',
                            'name'              => '5',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106006',
                            'name'              => '6',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106007',
                            'name'              => '7',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106008',
                            'name'              => '8',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106009',
                            'name'              => '9',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106010',
                            'name'              => '10',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106011',
                            'name'              => '11',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106012',
                            'name'              => '12',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106013',
                            'name'              => '13',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106014',
                            'name'              => '14',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106015',
                            'name'              => '15',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106016',
                            'name'              => '16',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106017',
                            'name'              => '17',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106018',
                            'name'              => '18',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106019',
                            'name'              => '19',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106020',
                            'name'              => '20',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106021',
                            'name'              => '21',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106022',
                            'name'              => '22',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106023',
                            'name'              => '23',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106024',
                            'name'              => '24',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106025',
                            'name'              => '25',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106026',
                            'name'              => '26',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106027',
                            'name'              => '27',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106028',
                            'name'              => '28',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52106029',
                            'name'              => '29',
                            'municipality'      => '6',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52201001',
                            'name'              => '1',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201002',
                            'name'              => '2',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201003',
                            'name'              => '3',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201004',
                            'name'              => '4',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201005',
                            'name'              => '5',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201006',
                            'name'              => '6',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201007',
                            'name'              => '7',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201008',
                            'name'              => '8',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201009',
                            'name'              => '9',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201010',
                            'name'              => '10',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201011',
                            'name'              => '11',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201012',
                            'name'              => '12',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52201013',
                            'name'              => '13',
                            'municipality'      => '7',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52202001',
                            'name'              => '1',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202002',
                            'name'              => '2',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202003',
                            'name'              => '3',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202004',
                            'name'              => '4',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202005',
                            'name'              => '5',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202006',
                            'name'              => '6',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202007',
                            'name'              => '7',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202008',
                            'name'              => '8',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202009',
                            'name'              => '9',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202010',
                            'name'              => '10',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202011',
                            'name'              => '11',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52202012',
                            'name'              => '12',
                            'municipality'      => '8',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52203001',
                            'name'              => '1',
                            'municipality'      => '9',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52203002',
                            'name'              => '2',
                            'municipality'      => '9',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52203003',
                            'name'              => '3',
                            'municipality'      => '9',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52203004',
                            'name'              => '4',
                            'municipality'      => '9',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52204001',
                            'name'              => '1',
                            'municipality'      => '10',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52204002',
                            'name'              => '2',
                            'municipality'      => '10',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52204003',
                            'name'              => '3',
                            'municipality'      => '10',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52204004',
                            'name'              => '4',
                            'municipality'      => '10',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52205001',
                            'name'              => '1',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205002',
                            'name'              => '2',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205003',
                            'name'              => '3',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205004',
                            'name'              => '4',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205005',
                            'name'              => '5',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205006',
                            'name'              => '6',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205007',
                            'name'              => '7',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205008',
                            'name'              => '8',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205009',
                            'name'              => '9',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205010',
                            'name'              => '10',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205011',
                            'name'              => '11',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52205012',
                            'name'              => '12',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205013',
                            'name'              => '13',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205014',
                            'name'              => '14',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205015',
                            'name'              => '15',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205016',
                            'name'              => '16',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205017',
                            'name'              => '17',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205018',
                            'name'              => '18',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205019',
                            'name'              => '19',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205020',
                            'name'              => '20',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205021',
                            'name'              => '21',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205022',
                            'name'              => '22',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205023',
                            'name'              => '23',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205024',
                            'name'              => '24',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205025',
                            'name'              => '25',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205026',
                            'name'              => '26',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205027',
                            'name'              => '27',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205028',
                            'name'              => '28',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205029',
                            'name'              => '29',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205030',
                            'name'              => '30',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205031',
                            'name'              => '31',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205032',
                            'name'              => '32',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205033',
                            'name'              => '33',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205034',
                            'name'              => '34',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205035',
                            'name'              => '35',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205036',
                            'name'              => '36',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52205037',
                            'name'              => '37',
                            'municipality'      => '11',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52206001',
                            'name'              => '1',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52206002',
                            'name'              => '2',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52206003',
                            'name'              => '3',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52206004',
                            'name'              => '4',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52206005',
                            'name'              => '5',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52206006',
                            'name'              => '6',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52206007',
                            'name'              => '7',
                            'municipality'      => '12',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],



                        [
                            'slug'              => '52207001',
                            'name'              => '1',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52207002',
                            'name'              => '2',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52207003',
                            'name'              => '3',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52207004',
                            'name'              => '4',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52207005',
                            'name'              => '5',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52207006',
                            'name'              => '6',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52207007',
                            'name'              => '7',
                            'municipality'      => '13',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52302001',
                            'name'              => '1',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302002',
                            'name'              => '2',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302003',
                            'name'              => '3',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302004',
                            'name'              => '4',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302005',
                            'name'              => '5',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302006',
                            'name'              => '6',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302007',
                            'name'              => '7',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302008',
                            'name'              => '8',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302009',
                            'name'              => '9',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302010',
                            'name'              => '10',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302011',
                            'name'              => '11',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52302012',
                            'name'              => '12',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302013',
                            'name'              => '13',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302014',
                            'name'              => '14',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302015',
                            'name'              => '15',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302016',
                            'name'              => '16',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302017',
                            'name'              => '17',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302018',
                            'name'              => '18',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302019',
                            'name'              => '19',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302020',
                            'name'              => '20',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302021',
                            'name'              => '21',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302022',
                            'name'              => '22',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302023',
                            'name'              => '23',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302024',
                            'name'              => '24',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302025',
                            'name'              => '25',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302026',
                            'name'              => '26',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52302027',
                            'name'              => '27',
                            'municipality'      => '14',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                         [
                            'slug'              => '52303001',
                            'name'              => '1',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303002',
                            'name'              => '2',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303003',
                            'name'              => '3',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303004',
                            'name'              => '4',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303005',
                            'name'              => '5',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303006',
                            'name'              => '6',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303007',
                            'name'              => '7',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303008',
                            'name'              => '8',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303009',
                            'name'              => '9',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52303010',
                            'name'              => '10',
                            'municipality'      => '15',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52304001',
                            'name'              => '1',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304002',
                            'name'              => '2',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304003',
                            'name'              => '3',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304004',
                            'name'              => '4',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304005',
                            'name'              => '5',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304006',
                            'name'              => '6',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304007',
                            'name'              => '7',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304008',
                            'name'              => '8',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52304009',
                            'name'              => '9',
                            'municipality'      => '16',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52305001',
                            'name'              => '1',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305002',
                            'name'              => '2',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305003',
                            'name'              => '3',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305004',
                            'name'              => '4',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305005',
                            'name'              => '5',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305006',
                            'name'              => '6',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305007',
                            'name'              => '7',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305008',
                            'name'              => '8',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305009',
                            'name'              => '9',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305010',
                            'name'              => '10',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305011',
                            'name'              => '11',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305012',
                            'name'              => '12',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305013',
                            'name'              => '13',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52305014',
                            'name'              => '14',
                            'municipality'      => '17',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52306001',
                            'name'              => '1',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306002',
                            'name'              => '2',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306003',
                            'name'              => '3',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306004',
                            'name'              => '4',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306005',
                            'name'              => '5',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306006',
                            'name'              => '6',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306007',
                            'name'              => '7',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306008',
                            'name'              => '8',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306009',
                            'name'              => '9',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306010',
                            'name'              => '10',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306011',
                            'name'              => '11',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306012',
                            'name'              => '12',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52306013',
                            'name'              => '13',
                            'municipality'      => '18',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52401001',
                            'name'              => '1',
                            'municipality'      => '19',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52401002',
                            'name'              => '2',
                            'municipality'      => '19',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52401003',
                            'name'              => '3',
                            'municipality'      => '19',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52401004',
                            'name'              => '4',
                            'municipality'      => '19',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52401005',
                            'name'              => '5',
                            'municipality'      => '19',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52401006',
                            'name'              => '6',
                            'municipality'      => '19',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52402001',
                            'name'              => '1',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402002',
                            'name'              => '2',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402003',
                            'name'              => '3',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402004',
                            'name'              => '4',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402005',
                            'name'              => '5',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402006',
                            'name'              => '6',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402007',
                            'name'              => '7',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402008',
                            'name'              => '8',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402009',
                            'name'              => '9',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402010',
                            'name'              => '10',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402011',
                            'name'              => '11',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402012',
                            'name'              => '12',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402013',
                            'name'              => '13',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402014',
                            'name'              => '14',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402015',
                            'name'              => '15',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402016',
                            'name'              => '16',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52402017',
                            'name'              => '17',
                            'municipality'      => '20',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52404001',
                            'name'              => '1',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404002',
                            'name'              => '2',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404003',
                            'name'              => '3',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404004',
                            'name'              => '4',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404005',
                            'name'              => '5',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404006',
                            'name'              => '6',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404007',
                            'name'              => '7',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404008',
                            'name'              => '8',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404009',
                            'name'              => '9',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404010',
                            'name'              => '10',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404011',
                            'name'              => '11',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404012',
                            'name'              => '12',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404013',
                            'name'              => '13',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404014',
                            'name'              => '14',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404015',
                            'name'              => '15',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404016',
                            'name'              => '16',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404017',
                            'name'              => '17',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404018',
                            'name'              => '18',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52404019',
                            'name'              => '19',
                            'municipality'      => '21',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52405001',
                            'name'              => '1',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405002',
                            'name'              => '2',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405003',
                            'name'              => '3',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405004',
                            'name'              => '4',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405005',
                            'name'              => '5',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405006',
                            'name'              => '6',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405007',
                            'name'              => '7',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405008',
                            'name'              => '8',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405009',
                            'name'              => '9',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405010',
                            'name'              => '10',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52405011',
                            'name'              => '11',
                            'municipality'      => '22',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52502001',
                            'name'              => '1',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502002',
                            'name'              => '2',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502003',
                            'name'              => '3',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502004',
                            'name'              => '4',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502005',
                            'name'              => '5',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502006',
                            'name'              => '6',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502007',
                            'name'              => '7',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502008',
                            'name'              => '8',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502009',
                            'name'              => '9',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502010',
                            'name'              => '10',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502011',
                            'name'              => '11',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52502012',
                            'name'              => '12',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502013',
                            'name'              => '13',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502014',
                            'name'              => '14',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502015',
                            'name'              => '15',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502016',
                            'name'              => '16',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502017',
                            'name'              => '17',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502018',
                            'name'              => '18',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502019',
                            'name'              => '19',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502020',
                            'name'              => '20',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502021',
                            'name'              => '21',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502022',
                            'name'              => '22',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502023',
                            'name'              => '23',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502024',
                            'name'              => '24',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502025',
                            'name'              => '25',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502026',
                            'name'              => '26',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502027',
                            'name'              => '27',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502028',
                            'name'              => '28',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502029',
                            'name'              => '29',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502030',
                            'name'              => '30',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52502031',
                            'name'              => '31',
                            'municipality'      => '23',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52503001',
                            'name'              => '1',
                            'municipality'      => '24',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52503002',
                            'name'              => '2',
                            'municipality'      => '24',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52503003',
                            'name'              => '3',
                            'municipality'      => '24',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52503004',
                            'name'              => '4',
                            'municipality'      => '24',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                       [
                            'slug'              => '52504001',
                            'name'              => '1',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504002',
                            'name'              => '2',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504003',
                            'name'              => '3',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504004',
                            'name'              => '4',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52504005',
                            'name'              => '5',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504006',
                            'name'              => '6',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504007',
                            'name'              => '7',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504008',
                            'name'              => '8',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504009',
                            'name'              => '9',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504010',
                            'name'              => '10',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52504011',
                            'name'              => '11',
                            'municipality'      => '25',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52601001',
                            'name'              => '1',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52601002',
                            'name'              => '2',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52601003',
                            'name'              => '3',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52601004',
                            'name'              => '4',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52601005',
                            'name'              => '5',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52601006',
                            'name'              => '6',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52601007',
                            'name'              => '7',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52601008',
                            'name'              => '8',
                            'municipality'      => '26',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52602001',
                            'name'              => '1',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602002',
                            'name'              => '2',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602003',
                            'name'              => '3',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602004',
                            'name'              => '4',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52602005',
                            'name'              => '5',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602006',
                            'name'              => '6',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602007',
                            'name'              => '7',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602008',
                            'name'              => '8',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602009',
                            'name'              => '9',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602010',
                            'name'              => '10',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602011',
                            'name'              => '11',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602012',
                            'name'              => '12',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602013',
                            'name'              => '13',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52602014',
                            'name'              => '14',
                            'municipality'      => '27',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52603001',
                            'name'              => '1',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603002',
                            'name'              => '2',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603003',
                            'name'              => '3',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603004',
                            'name'              => '4',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52603005',
                            'name'              => '5',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603006',
                            'name'              => '6',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603007',
                            'name'              => '7',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603008',
                            'name'              => '8',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603009',
                            'name'              => '9',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603010',
                            'name'              => '10',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603011',
                            'name'              => '11',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603012',
                            'name'              => '12',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603013',
                            'name'              => '13',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603014',
                            'name'              => '14',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603015',
                            'name'              => '15',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603016',
                            'name'              => '16',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603017',
                            'name'              => '17',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603018',
                            'name'              => '18',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603019',
                            'name'              => '19',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603020',
                            'name'              => '20',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603021',
                            'name'              => '21',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52603022',
                            'name'              => '22',
                            'municipality'      => '28',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52605001',
                            'name'              => '1',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605002',
                            'name'              => '2',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605003',
                            'name'              => '3',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605004',
                            'name'              => '4',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52605005',
                            'name'              => '5',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605006',
                            'name'              => '6',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605007',
                            'name'              => '7',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605008',
                            'name'              => '8',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605009',
                            'name'              => '9',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605010',
                            'name'              => '10',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605011',
                            'name'              => '11',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605012',
                            'name'              => '12',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605013',
                            'name'              => '13',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605014',
                            'name'              => '14',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605015',
                            'name'              => '15',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605016',
                            'name'              => '16',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605017',
                            'name'              => '17',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605018',
                            'name'              => '18',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605019',
                            'name'              => '19',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605020',
                            'name'              => '20',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52605021',
                            'name'              => '21',
                            'municipality'      => '29',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52606001',
                            'name'              => '1',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606002',
                            'name'              => '2',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606003',
                            'name'              => '3',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606004',
                            'name'              => '4',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52606005',
                            'name'              => '5',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606006',
                            'name'              => '6',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606007',
                            'name'              => '7',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606008',
                            'name'              => '8',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606009',
                            'name'              => '9',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606010',
                            'name'              => '10',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606011',
                            'name'              => '11',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606012',
                            'name'              => '12',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606013',
                            'name'              => '13',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606014',
                            'name'              => '14',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606015',
                            'name'              => '15',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606016',
                            'name'              => '16',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606017',
                            'name'              => '17',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606018',
                            'name'              => '18',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606019',
                            'name'              => '19',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606020',
                            'name'              => '20',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606021',
                            'name'              => '21',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606022',
                            'name'              => '22',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606023',
                            'name'              => '23',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52606024',
                            'name'              => '24',
                            'municipality'      => '30',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52701001',
                            'name'              => '1',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701002',
                            'name'              => '2',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701003',
                            'name'              => '3',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701004',
                            'name'              => '4',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52701005',
                            'name'              => '5',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701006',
                            'name'              => '6',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701007',
                            'name'              => '7',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701008',
                            'name'              => '8',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701009',
                            'name'              => '9',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701010',
                            'name'              => '10',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701011',
                            'name'              => '11',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701012',
                            'name'              => '12',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701013',
                            'name'              => '13',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701014',
                            'name'              => '14',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701015',
                            'name'              => '15',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701016',
                            'name'              => '16',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52701017',
                            'name'              => '17',
                            'municipality'      => '31',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52702001',
                            'name'              => '1',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702002',
                            'name'              => '2',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702003',
                            'name'              => '3',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702004',
                            'name'              => '4',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52702005',
                            'name'              => '5',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702006',
                            'name'              => '6',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702007',
                            'name'              => '7',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702008',
                            'name'              => '8',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702009',
                            'name'              => '9',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702010',
                            'name'              => '10',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702011',
                            'name'              => '11',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702012',
                            'name'              => '12',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702013',
                            'name'              => '13',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702014',
                            'name'              => '14',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702015',
                            'name'              => '15',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702016',
                            'name'              => '16',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702017',
                            'name'              => '17',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702018',
                            'name'              => '18',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702019',
                            'name'              => '19',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52702020',
                            'name'              => '20',
                            'municipality'      => '32',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52703001',
                            'name'              => '1',
                            'municipality'      => '33',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52703002',
                            'name'              => '2',
                            'municipality'      => '33',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52703003',
                            'name'              => '3',
                            'municipality'      => '33',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52703004',
                            'name'              => '4',
                            'municipality'      => '33',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                         [
                            'slug'              => '52704001',
                            'name'              => '1',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704002',
                            'name'              => '2',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704003',
                            'name'              => '3',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704004',
                            'name'              => '4',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704005',
                            'name'              => '5',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704006',
                            'name'              => '6',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704007',
                            'name'              => '7',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52704008',
                            'name'              => '8',
                            'municipality'      => '34',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52705001',
                            'name'              => '1',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705002',
                            'name'              => '2',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705003',
                            'name'              => '3',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705004',
                            'name'              => '4',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705005',
                            'name'              => '5',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705006',
                            'name'              => '6',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705007',
                            'name'              => '7',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705008',
                            'name'              => '8',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705009',
                            'name'              => '9',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705010',
                            'name'              => '10',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705011',
                            'name'              => '11',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705012',
                            'name'              => '12',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705013',
                            'name'              => '13',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705014',
                            'name'              => '14',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705015',
                            'name'              => '15',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705016',
                            'name'              => '16',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705017',
                            'name'              => '17',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705018',
                            'name'              => '18',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52705019',
                            'name'              => '19',
                            'municipality'      => '35',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52801001',
                            'name'              => '1',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801002',
                            'name'              => '2',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801003',
                            'name'              => '3',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801004',
                            'name'              => '4',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801005',
                            'name'              => '5',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801006',
                            'name'              => '6',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801007',
                            'name'              => '7',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801008',
                            'name'              => '8',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801009',
                            'name'              => '9',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801010',
                            'name'              => '10',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801011',
                            'name'              => '11',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801012',
                            'name'              => '12',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801013',
                            'name'              => '13',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801014',
                            'name'              => '14',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52801015',
                            'name'              => '15',
                            'municipality'      => '36',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52802001',
                            'name'              => '1',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802002',
                            'name'              => '2',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802003',
                            'name'              => '3',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802004',
                            'name'              => '4',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802005',
                            'name'              => '5',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802006',
                            'name'              => '6',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802007',
                            'name'              => '7',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802008',
                            'name'              => '8',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802009',
                            'name'              => '9',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802010',
                            'name'              => '10',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802011',
                            'name'              => '11',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802012',
                            'name'              => '12',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802013',
                            'name'              => '13',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802014',
                            'name'              => '14',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802015',
                            'name'              => '15',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802016',
                            'name'              => '16',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802017',
                            'name'              => '17',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802018',
                            'name'              => '18',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802019',
                            'name'              => '19',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802020',
                            'name'              => '20',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802021',
                            'name'              => '21',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802022',
                            'name'              => '22',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802023',
                            'name'              => '23',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802024',
                            'name'              => '24',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802025',
                            'name'              => '25',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802026',
                            'name'              => '26',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802027',
                            'name'              => '27',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802028',
                            'name'              => '28',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802029',
                            'name'              => '29',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52802030',
                            'name'              => '30',
                            'municipality'      => '37',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52803001',
                            'name'              => '1',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803002',
                            'name'              => '2',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803003',
                            'name'              => '3',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803004',
                            'name'              => '4',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803005',
                            'name'              => '5',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803006',
                            'name'              => '6',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803007',
                            'name'              => '7',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52803008',
                            'name'              => '8',
                            'municipality'      => '38',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52804001',
                            'name'              => '1',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804002',
                            'name'              => '2',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804003',
                            'name'              => '3',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804004',
                            'name'              => '4',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804005',
                            'name'              => '5',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804006',
                            'name'              => '6',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804007',
                            'name'              => '7',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804008',
                            'name'              => '8',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804009',
                            'name'              => '9',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804010',
                            'name'              => '10',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804011',
                            'name'              => '11',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804012',
                            'name'              => '12',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804013',
                            'name'              => '13',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804014',
                            'name'              => '14',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804015',
                            'name'              => '15',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804016',
                            'name'              => '16',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804017',
                            'name'              => '17',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804018',
                            'name'              => '18',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804019',
                            'name'              => '19',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804020',
                            'name'              => '20',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804021',
                            'name'              => '21',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804022',
                            'name'              => '22',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804023',
                            'name'              => '23',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804024',
                            'name'              => '24',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804025',
                            'name'              => '25',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52804026',
                            'name'              => '26',
                            'municipality'      => '39',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52805001',
                            'name'              => '1',
                            'municipality'      => '40',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52805002',
                            'name'              => '2',
                            'municipality'      => '40',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52805003',
                            'name'              => '3',
                            'municipality'      => '40',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52805004',
                            'name'              => '4',
                            'municipality'      => '40',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52805005',
                            'name'              => '5',
                            'municipality'      => '40',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52805006',
                            'name'              => '6',
                            'municipality'      => '40',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '52806001',
                            'name'              => '1',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806002',
                            'name'              => '2',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806003',
                            'name'              => '3',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806004',
                            'name'              => '4',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806005',
                            'name'              => '5',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806006',
                            'name'              => '6',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806007',
                            'name'              => '7',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806008',
                            'name'              => '8',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806009',
                            'name'              => '9',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806010',
                            'name'              => '10',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806011',
                            'name'              => '11',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806012',
                            'name'              => '12',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806013',
                            'name'              => '13',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52806014',
                            'name'              => '14',
                            'municipality'      => '41',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901001',
                            'name'              => '1',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901002',
                            'name'              => '2',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901003',
                            'name'              => '3',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901004',
                            'name'              => '4',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901005',
                            'name'              => '5',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901006',
                            'name'              => '6',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901007',
                            'name'              => '7',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901008',
                            'name'              => '8',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901009',
                            'name'              => '9',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901010',
                            'name'              => '10',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901011',
                            'name'              => '11',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901012',
                            'name'              => '12',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901013',
                            'name'              => '13',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901014',
                            'name'              => '14',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901015',
                            'name'              => '15',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901016',
                            'name'              => '16',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52901017',
                            'name'              => '17',
                            'municipality'      => '42',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],



                        [
                            'slug'              => '52902001',
                            'name'              => '1',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902002',
                            'name'              => '2',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902003',
                            'name'              => '3',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902004',
                            'name'              => '4',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902005',
                            'name'              => '5',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902006',
                            'name'              => '6',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902007',
                            'name'              => '7',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902008',
                            'name'              => '8',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902009',
                            'name'              => '9',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902010',
                            'name'              => '10',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902011',
                            'name'              => '11',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902012',
                            'name'              => '12',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902013',
                            'name'              => '13',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902014',
                            'name'              => '14',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902015',
                            'name'              => '15',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902016',
                            'name'              => '16',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902017',
                            'name'              => '17',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902018',
                            'name'              => '18',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902019',
                            'name'              => '19',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902020',
                            'name'              => '20',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902021',
                            'name'              => '21',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902022',
                            'name'              => '22',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902023',
                            'name'              => '23',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902024',
                            'name'              => '24',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902025',
                            'name'              => '25',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902026',
                            'name'              => '26',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52902027',
                            'name'              => '27',
                            'municipality'      => '43',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52903001',
                            'name'              => '1',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903002',
                            'name'              => '2',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903003',
                            'name'              => '3',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903004',
                            'name'              => '4',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903005',
                            'name'              => '5',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903006',
                            'name'              => '6',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903007',
                            'name'              => '7',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903008',
                            'name'              => '8',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903009',
                            'name'              => '9',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903010',
                            'name'              => '10',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903011',
                            'name'              => '11',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903012',
                            'name'              => '12',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903013',
                            'name'              => '13',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903014',
                            'name'              => '14',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903015',
                            'name'              => '15',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903016',
                            'name'              => '16',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903017',
                            'name'              => '17',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903018',
                            'name'              => '18',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52903019',
                            'name'              => '19',
                            'municipality'      => '44',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '52904001',
                            'name'              => '1',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904002',
                            'name'              => '2',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904003',
                            'name'              => '3',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904004',
                            'name'              => '4',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904005',
                            'name'              => '5',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904006',
                            'name'              => '6',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904007',
                            'name'              => '7',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904008',
                            'name'              => '8',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904009',
                            'name'              => '9',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904010',
                            'name'              => '10',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '52904011',
                            'name'              => '11',
                            'municipality'      => '45',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '54301001',
                            'name'              => '1',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301002',
                            'name'              => '2',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301003',
                            'name'              => '3',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301004',
                            'name'              => '4',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301005',
                            'name'              => '5',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301006',
                            'name'              => '6',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301007',
                            'name'              => '7',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301008',
                            'name'              => '8',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301009',
                            'name'              => '9',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301010',
                            'name'              => '10',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54301011',
                            'name'              => '11',
                            'municipality'      => '46',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '54302001',
                            'name'              => '1',
                            'municipality'      => '47',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54302002',
                            'name'              => '2',
                            'municipality'      => '47',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54302003',
                            'name'              => '3',
                            'municipality'      => '47',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54302004',
                            'name'              => '4',
                            'municipality'      => '47',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54303001',
                            'name'              => '1',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303002',
                            'name'              => '2',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303003',
                            'name'              => '3',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303004',
                            'name'              => '4',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303005',
                            'name'              => '5',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303006',
                            'name'              => '6',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303007',
                            'name'              => '7',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54303008',
                            'name'              => '8',
                            'municipality'      => '48',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '54304001',
                            'name'              => '1',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304002',
                            'name'              => '2',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304003',
                            'name'              => '3',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304004',
                            'name'              => '4',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304005',
                            'name'              => '5',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304006',
                            'name'              => '6',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304007',
                            'name'              => '7',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304008',
                            'name'              => '8',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304009',
                            'name'              => '9',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304010',
                            'name'              => '10',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304011',
                            'name'              => '11',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54304012',
                            'name'              => '12',
                            'municipality'      => '49',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],



                        [
                            'slug'              => '54305001',
                            'name'              => '1',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305002',
                            'name'              => '2',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305003',
                            'name'              => '3',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305004',
                            'name'              => '4',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305005',
                            'name'              => '5',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305006',
                            'name'              => '6',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305007',
                            'name'              => '7',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305008',
                            'name'              => '8',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305009',
                            'name'              => '9',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305010',
                            'name'              => '10',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305011',
                            'name'              => '11',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '54305012',
                            'name'              => '12',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305013',
                            'name'              => '13',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305014',
                            'name'              => '14',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305015',
                            'name'              => '15',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305016',
                            'name'              => '16',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305017',
                            'name'              => '17',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305018',
                            'name'              => '18',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305019',
                            'name'              => '19',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '54305020',
                            'name'              => '20',
                            'municipality'      => '50',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],





                        [
                            'slug'              => '59500001',
                            'name'              => '1',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500002',
                            'name'              => '2',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500003',
                            'name'              => '3',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500004',
                            'name'              => '4',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500005',
                            'name'              => '5',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500006',
                            'name'              => '6',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500007',
                            'name'              => '7',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500008',
                            'name'              => '8',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500009',
                            'name'              => '9',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500010',
                            'name'              => '10',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500011',
                            'name'              => '11',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500012',
                            'name'              => '12',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500013',
                            'name'              => '13',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500014',
                            'name'              => '14',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500015',
                            'name'              => '15',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500016',
                            'name'              => '16',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500017',
                            'name'              => '17',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500018',
                            'name'              => '18',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500019',
                            'name'              => '19',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500020',
                            'name'              => '20',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500021',
                            'name'              => '21',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500022',
                            'name'              => '22',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500023',
                            'name'              => '23',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500024',
                            'name'              => '24',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500025',
                            'name'              => '25',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500026',
                            'name'              => '26',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500027',
                            'name'              => '27',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500028',
                            'name'              => '28',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500029',
                            'name'              => '29',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500030',
                            'name'              => '30',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500031',
                            'name'              => '31',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500032',
                            'name'              => '32',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500033',
                            'name'              => '33',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500034',
                            'name'              => '34',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500035',
                            'name'              => '35',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500036',
                            'name'              => '36',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500037',
                            'name'              => '37',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500038',
                            'name'              => '38',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500039',
                            'name'              => '39',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500040',
                            'name'              => '40',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500041',
                            'name'              => '41',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500042',
                            'name'              => '42',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500043',
                            'name'              => '43',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500044',
                            'name'              => '44',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500045',
                            'name'              => '45',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500046',
                            'name'              => '46',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500047',
                            'name'              => '47',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500048',
                            'name'              => '48',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500049',
                            'name'              => '49',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500050',
                            'name'              => '50',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500051',
                            'name'              => '51',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500052',
                            'name'              => '52',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500053',
                            'name'              => '53',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500054',
                            'name'              => '54',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500055',
                            'name'              => '55',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500056',
                            'name'              => '56',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500057',
                            'name'              => '57',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500058',
                            'name'              => '58',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500059',
                            'name'              => '59',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500060',
                            'name'              => '60',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500061',
                            'name'              => '61',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500062',
                            'name'              => '62',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500063',
                            'name'              => '63',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500064',
                            'name'              => '64',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500065',
                            'name'              => '65',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500066',
                            'name'              => '66',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500067',
                            'name'              => '67',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500068',
                            'name'              => '68',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500069',
                            'name'              => '69',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500070',
                            'name'              => '70',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500071',
                            'name'              => '71',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500072',
                            'name'              => '72',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500073',
                            'name'              => '73',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500074',
                            'name'              => '74',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500075',
                            'name'              => '75',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500076',
                            'name'              => '76',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500077',
                            'name'              => '77',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500078',
                            'name'              => '78',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500079',
                            'name'              => '79',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500080',
                            'name'              => '80',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500081',
                            'name'              => '81',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500082',
                            'name'              => '82',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500083',
                            'name'              => '83',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500084',
                            'name'              => '84',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500085',
                            'name'              => '85',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500086',
                            'name'              => '86',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500087',
                            'name'              => '87',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500088',
                            'name'              => '88',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500089',
                            'name'              => '89',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],


                        [
                            'slug'              => '59500090',
                            'name'              => '90',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500091',
                            'name'              => '91',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500092',
                            'name'              => '92',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500093',
                            'name'              => '93',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500094',
                            'name'              => '94',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500095',
                            'name'              => '95',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500096',
                            'name'              => '96',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500097',
                            'name'              => '97',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                       [
                            'slug'              => '59500098',
                            'name'              => '98',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                       [
                            'slug'              => '59500099',
                            'name'              => '99',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                       [
                            'slug'              => '59500100',
                            'name'              => '100',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500101',
                            'name'              => '101',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],

                        [
                            'slug'              => '59500102',
                            'name'              => '102',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ],
                        [
                            'slug'              => '59500103',
                            'name'              => '103',
                            'municipality'      => '51',
                            'created_at'        =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()
                        ]



            ];

        foreach ($wards as $ward) {
                Ward::create($ward);
        }







    }
}
