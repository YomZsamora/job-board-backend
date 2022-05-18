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
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('cohort_id', 'cohort');
            $table->string('api_token', 80)->unique()
                        ->nullable()
                        ->default(null)
                        ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('cohort', 'cohort_id');
            $table->string('api_token', 80)->unique()
                        ->nullable()
                        ->default(null)
                        ->after('password');
        });
    }
};
