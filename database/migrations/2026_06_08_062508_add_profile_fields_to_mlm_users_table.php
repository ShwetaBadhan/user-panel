<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('mlm_users', function (Blueprint $table) {
        $table->string('father_name')->nullable()->after('last_name');
        $table->date('dob')->nullable()->after('father_name');
        $table->enum('sex', ['Male', 'Female', 'Other'])->nullable()->after('dob');
        $table->text('address')->nullable()->after('sex');
        $table->string('pincode', 10)->nullable()->after('address');
        $table->string('gstin', 20)->nullable()->after('pincode');
        $table->string('state')->nullable()->after('gstin');
        $table->string('district')->nullable()->after('state');
        $table->string('bank_name')->nullable()->after('district');
        $table->string('branch_name')->nullable()->after('bank_name');
        $table->string('account_type')->nullable()->after('branch_name');
        $table->string('account_number')->nullable()->after('account_type');
        $table->string('account_holder_name')->nullable()->after('account_number');
        $table->string('ifsc_code', 20)->nullable()->after('account_holder_name');
        $table->string('nominee_name')->nullable()->after('ifsc_code');
        $table->string('nominee_relation')->nullable()->after('nominee_name');
        $table->integer('profile_update_count')->default(0)->after('nominee_relation');
    });
}

public function down()
{
    Schema::table('mlm_users', function (Blueprint $table) {
        $table->dropColumn([
            'father_name', 'dob', 'sex', 'address', 'pincode', 'gstin', 'state', 'district',
            'bank_name', 'branch_name', 'account_type', 'account_number', 'account_holder_name', 'ifsc_code',
            'nominee_name', 'nominee_relation', 'profile_update_count'
        ]);
    });
}
};
