<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('health_issue_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('family_history_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('guardian');
            $table->mediumText('address');
            $table->string('contact');
            $table->string('relationship');
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
        Schema::dropIfExists('health_profiles');
    }
}
