<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->mediumText('description');
            $table->string('location');
            $table->string('organizer');
            $table->string('contact');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('events');
    }
}
