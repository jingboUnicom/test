<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable()->after('name');
            $table->string('contact_name')->nullable()->after('surname');
            $table->string('position')->nullable()->after('password');
            $table->string('department')->nullable()->after('position');
            $table->foreignId('company_id')->nullable()->after('department');
            $table->string('phone')->nullable()->after('company_id');
            $table->boolean('agent')->default(false)->after('super');
            $table->boolean('employer')->default(false)->after('agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('employer');
            $table->dropColumn('agent');
            $table->dropColumn('phone');
            $table->dropColumn('company_id');
            $table->dropColumn('department');
            $table->dropColumn('position');
            $table->dropColumn('contact_name');
            $table->dropColumn('surname');
        });
    }
};
