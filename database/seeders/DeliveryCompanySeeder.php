<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryCompany;

class DeliveryCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $wilayas = [
            'أدرار','الشلف','الأغواط','أم البواقي','باتنة','بجاية','بسكرة','بشار','البليدة','البويرة',
            'تمنراست','تبسة','تلمسان','تيارت','تيزي وزو','الجزائر','الجلفة','جيجل','سطيف','سعيدة',
            'سكيكدة','سيدي بلعباس','عنابة','قالمة','قسنطينة','المدية','مستغانم','المسيلة','معسكر','ورقلة',
            'وهران','البيض','إليزي','برج بوعريريج','بومرداس','الطارف','تندوف','تيسمسيلت','الوادي','خنشلة',
            'سوق أهراس','تيبازة','ميلة','عين الدفلى','النعامة','عين تموشنت','غرداية','غليزان',
            'تيميمون','برج باجي مختار','أولاد جلال','بني عباس','عين صالح','عين قزام','تقرت','جانت','المغير','المنيعة'
        ];

        // شركة واحدة كمثال
        $company = DeliveryCompany::create([
            'name' => 'Youssi Express',
            'phone' => '0555 00 00 00',
            'email' => 'youssi@example.com',
            'address' => 'الجزائر العاصمة',
        ]);

        // إضافة 58 ولاية مع أسعار
        foreach ($wilayas as $wilaya) {
            $company->delivery_zones()->create([
                'wilaya' => $wilaya,
                'price_to_office' => rand(150, 400), // سعر عشوائي بين 150 و 400
                'price_to_home'   => rand(200, 500), // سعر عشوائي بين 200 و 500
            ]);
        }
    }
}
