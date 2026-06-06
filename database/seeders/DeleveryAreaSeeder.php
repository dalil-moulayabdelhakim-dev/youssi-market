<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleveryAreaSeeder extends Seeder
{
    private $wilayas = [
        [
            "id" => "1",
            "name" => "Adrar",
            "ar_name" => "أدرار",
            "home_price" => "1300",
            "SD_price" => "700",
            "store_id" => 1
        ],
        [
            "id" => "2",
            "name" => "Chlef",
            "ar_name" => "الشلف",
            "home_price" => "850",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "3",
            "name" => "Laghouat",
            "ar_name" => "الأغواط",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "4",
            "name" => "Oum El Bouaghi",
            "ar_name" => "أم البواقي",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "5",
            "name" => "Batna",
            "ar_name" => "باتنة",
            "home_price" => "900",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "6",
            "name" => "Béjaïa",
            "ar_name" => "بجاية",
            "home_price" => "800",
            "SD_price" => "400",
            "store_id" => 1
        ],
        [
            "id" => "7",
            "name" => "Biskra",
            "ar_name" => "بسكرة",
            "home_price" => "950",
            "SD_price" => "550",
            "store_id" => 1
        ],
        [
            "id" => "8",
            "name" => "Bechar",
            "ar_name" => "بشار",
            "home_price" => "1100",
            "SD_price" => "650",
            "store_id" => 1
        ],
        [
            "id" => "9",
            "name" => "Blida",
            "ar_name" => "البليدة",
            "home_price" => "600",
            "SD_price" => "250",
            "store_id" => 1
        ],
        [
            "id" => "10",
            "name" => "Bouira",
            "ar_name" => "البويرة",
            "home_price" => "700",
            "SD_price" => "400",
            "store_id" => 1
        ],
        [
            "id" => "11",
            "name" => "Tamanrasset",
            "ar_name" => "تمنراست",
            "home_price" => "1700",
            "SD_price" => "1050",
            "store_id" => 1
        ],
        [
            "id" => "12",
            "name" => "Tbessa",
            "ar_name" => "تبسة",
            "home_price" => "800",
            "SD_price" => "400",
            "store_id" => 1
        ],
        [
            "id" => "13",
            "name" => "Tlemcen",
            "ar_name" => "تلمسان",
            "home_price" => "800",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "14",
            "name" => "Tiaret",
            "ar_name" => "تيارت",
            "home_price" => "750",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "15",
            "name" => "Tizi Ouzou",
            "ar_name" => "تيزي وزو",
            "home_price" => "750",
            "SD_price" => "400",
            "store_id" => 1
        ],
        [
            "id" => "16",
            "name" => "Alger",
            "ar_name" => "الجزائر",
            "home_price" => "400",
            "SD_price" => "200",
            "store_id" => 1
        ],
        [
            "id" => "17",
            "name" => "Djelfa",
            "ar_name" => "الجلفة",
            "home_price" => "950",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "18",
            "name" => "Jijel",
            "ar_name" => "جيجل",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "19",
            "name" => "Setif",
            "ar_name" => "سطيف",
            "home_price" => "800",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "20",
            "name" => "Saeda",
            "ar_name" => "سعيدة",
            "home_price" => "900",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "21",
            "name" => "Skikda",
            "ar_name" => "سكيكدة",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "22",
            "name" => "Sidi Bel Abbes",
            "ar_name" => "سيدي بلعباس",
            "home_price" => "850",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "23",
            "name" => "Annaba",
            "ar_name" => "عنابة",
            "home_price" => "850",
            "SD_price" => "400",
            "store_id" => 1
        ],
        [
            "id" => "24",
            "name" => "Guelma",
            "ar_name" => "قالمة",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "25",
            "name" => "Constantine",
            "ar_name" => "قسنطينة",
            "home_price" => "800",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "26",
            "name" => "Medea",
            "ar_name" => "المدية",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "27",
            "name" => "Mostaganem",
            "ar_name" => "مستغانم",
            "home_price" => "900",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "28",
            "name" => "M'Sila",
            "ar_name" => "المسيلة",
            "home_price" => "850",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "29",
            "name" => "Mascara",
            "ar_name" => "معسكر",
            "home_price" => "900",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "30",
            "name" => "Ouargla",
            "ar_name" => "ورقلة",
            "home_price" => "900",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "31",
            "name" => "Oran",
            "ar_name" => "وهران",
            "home_price" => "800",
            "SD_price" => "450",
            "store_id" => 1
        ],
        [
            "id" => "32",
            "name" => "El Bayadh",
            "ar_name" => "البيض",
            "home_price" => "1100",
            "SD_price" => "600",
            "store_id" => 1
        ],
        [
            "id" => "33",
            "name" => "Illizi",
            "ar_name" => "إليزي",
            "home_price" => "1300",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "34",
            "name" => "Bordj Bou Arreridj",
            "ar_name" => "برج بوعريريج",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "35",
            "name" => "Boumerdes",
            "ar_name" => "بومرداس",
            "home_price" => "700",
            "SD_price" => "350",
            "store_id" => 1
        ],
        [
            "id" => "36",
            "name" => "El Tarf",
            "ar_name" => "الطارف",
            "home_price" => "850",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "37",
            "name" => "Tindouf",
            "ar_name" => "تندوف",
            "home_price" => "1300",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "38",
            "name" => "Tissemsilt",
            "ar_name" => "تيسمسيلت",
            "home_price" => "850",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "39",
            "name" => "El Oued",
            "ar_name" => "الوادي",
            "home_price" => "950",
            "SD_price" => "600",
            "store_id" => 1
        ],
        [
            "id" => "40",
            "name" => "Khenchela",
            "ar_name" => "خنشلة",
            "home_price" => "800",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "41",
            "name" => "Souk Ahras",
            "ar_name" => "سوق أهراس",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "42",
            "name" => "Tipaza",
            "ar_name" => "تيبازة",
            "home_price" => "700",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "43",
            "name" => "Mila",
            "ar_name" => "ميلة",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "44",
            "name" => "Ain Defla",
            "ar_name" => "عين الدفلى",
            "home_price" => "800",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "45",
            "name" => "Naama",
            "ar_name" => "النعامة",
            "home_price" => "1200",
            "SD_price" => "600",
            "store_id" => 1
        ],
        [
            "id" => "46",
            "name" => "Ain Temouchent",
            "ar_name" => "عين تموشنت",
            "home_price" => "900",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "47",
            "name" => "Ghardaefa",
            "ar_name" => "غرداية",
            "home_price" => "1000",
            "SD_price" => "700",
            "store_id" => 1
        ],
        [
            "id" => "48",
            "name" => "Relizane",
            "ar_name" => "غليزان",
            "home_price" => "900",
            "SD_price" => "600",
            "store_id" => 1
        ],
        [
            "id" => "49",
            "name" => "Timimoun",
            "ar_name" => "تيميمون",
            "home_price" => "1500",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "50",
            "name" => "Bordj Baji Mokhtar",
            "ar_name" => "برج باجي مختار",
            "home_price" => "1400",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "51",
            "name" => "Ouled Djellal",
            "ar_name" => "أولاد جلال",
            "home_price" => "1000",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "52",
            "name" => "Béni Abbès",
            "ar_name" => "بني عباس",
            "home_price" => "1000",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "53",
            "name" => "In Salah",
            "ar_name" => "ان صالح",
            "home_price" => "1800",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "54",
            "name" => "In gezzam",
            "ar_name" => "ان غزام",
            "home_price" => "1400",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "55",
            "name" => "Touggourt",
            "ar_name" => "تقرت",
            "home_price" => "1000",
            "SD_price" => "500",
            "store_id" => 1
        ],
        [
            "id" => "56",
            "name" => "Djanet",
            "ar_name" => "جانت",
            "home_price" => "1300",
            "SD_price" => "",
            "store_id" => 1
        ],
        [
            "id" => "57",
            "name" => "El Mghira",
            "ar_name" => "المغيرة",
            "home_price" => "1100",
            "SD_price" => "900",
            "store_id" => 1
        ],
        [
            "id" => "58",
            "name" => "El Menia",
            "ar_name" => "المنيعة",
            "home_price" => "1100",
            "SD_price" => "1000",
            "store_id" => 1
        ],
    ];
    public function run(): void
    {
        DB::table('delevery_areas')->insert($this->wilayas);
    }
}
