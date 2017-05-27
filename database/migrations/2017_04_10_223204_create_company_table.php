<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('about')->nullable();
            $table->string('company_size')->nullable();
            $table->string('phone')->nullable();
            $table->string('industry')->nullable();
            $table->string('fax')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('logo')->nullable();
            $table->text('cover')->nullable();
            $table->double('latitude', 20, 10)->nullable();
            $table->double('langtude', 20, 10)->nullable();
            $table->enum('type', ['trial', 'paid'])->default('trial');
            $table->integer('expire_date');
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
        Schema::dropIfExists('companies');
    }
}