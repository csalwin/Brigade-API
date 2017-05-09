<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('userID');
            $table->string('leadSource');
            $table->string('name');
            $table->string('company');
            $table->string('address');
            $table->string('telephone');
            $table->string('email');
            $table->string('fleet');
            $table->string('industry');
            $table->string('industryOther');
            $table->string('customerType');
            $table->string('customerTypeOther');
            $table->string('productInterest');
            $table->string('productInterestOther');
            $table->text('productNotes');
            $table->integer('subscribeNewsletters');
            $table->integer('subscribeBrochures');
            $table->text('nextAction');
            $table->text('nextActionOther');
            $table->string('accountManager');
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}

