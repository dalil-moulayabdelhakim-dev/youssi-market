<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('subscription_methods', 'display_name_en')) {
            Schema::table('subscription_methods', function (Blueprint $table) {
                $table->string('display_name_en')->nullable();
                $table->string('display_name_ar')->nullable();
                $table->text('features_en')->nullable();
                $table->text('features_ar')->nullable();
            });
        }

        if (!Schema::hasColumn('administrative_information', 'default_commission_rate')) {
            Schema::table('administrative_information', function (Blueprint $table) {
                $table->decimal('default_commission_rate', 5, 2)->default(3.00);
            });
        }

        // Populate existing subscription methods with default prices and features if they are already in the DB
        DB::table('subscription_methods')->where('name', 'monthly')->update([
            'display_name_en' => 'Monthly Subscription',
            'display_name_ar' => 'الاشتراك الشهري',
            'features_en' => "Add unlimited number of products\nStore appears in search results\nTechnical support via WhatsApp",
            'features_ar' => "إضافة عدد غير محدود من المنتجات\nظهور المتجر في نتائج البحث\nالدعم الفني عبر الواتساب",
        ]);

        DB::table('subscription_methods')->where('name', 'yearly')->update([
            'display_name_en' => 'Yearly Subscription',
            'display_name_ar' => 'الاشتراك السنوي',
            'features_en' => "All features of monthly subscription\n2 months free discount\nPriority support via phone",
            'features_ar' => "جميع مميزات الاشتراك الشهري\nخصم شهرين مجانيين\nالدعم ذو الأولوية عبر الهاتف",
        ]);

        DB::table('subscription_methods')->where('name', 'trial')->update([
            'display_name_en' => 'Trial Period',
            'display_name_ar' => 'فترة تجريبية',
            'features_en' => "Try the platform for free for 1 month",
            'features_ar' => "تجربة المنصة مجاناً لمدة شهر",
        ]);

        // Populate default commission rate for existing settings row
        DB::table('administrative_information')->update([
            'default_commission_rate' => 3.00
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_methods', function (Blueprint $table) {
            $table->dropColumn(['display_name_en', 'display_name_ar', 'features_en', 'features_ar']);
        });

        Schema::table('administrative_information', function (Blueprint $table) {
            $table->dropColumn('default_commission_rate');
        });
    }
};
