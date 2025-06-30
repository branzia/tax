<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customer_groups', function (Blueprint $table) {
            $table->foreignId('tax_class_id')->nullable()->constrained('tax_classes')->nullOnDelete()->after('code');
        });
    }

    public function down(): void
    {
        Schema::table('customer_groups', function (Blueprint $table) {
            $table->dropForeign(['tax_class_id']);
            $table->dropColumn('tax_class_id');
        });
    }
};
