<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCorrupters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corrupters', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->date('case_date');
            $table->string('jabatan', 100);
            $table->string('partai', 100);
            $table->text('kasus');
            $table->integer('uang');
            $table->string('hukuman', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corrupters');
    }
}
