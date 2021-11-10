<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addjobcolumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('internships', function (Blueprint $table) {
            $table->string('requiredcourse');
            $table->string('deadline');
            $table->string('salary');
            $table->string('companyemail');
            $table->string('companyweb');
            $table->string('companyhistory');
            $table->string('companylogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internships', function (Blueprint $table) {
            $table->string('requiredcourse');
            $table->string('deadline');
            $table->string('companyemail');
            $table->string('companyweb');
            $table->string('companyhistory');
            $table->string('salary');
            $table->string('companylogo');
        });
    }
}
