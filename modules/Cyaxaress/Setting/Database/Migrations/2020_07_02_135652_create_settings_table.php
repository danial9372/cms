<?php

 use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
             $table->string('key',50)->index();
            $table->longText('value')->nullable();
            $table->text('extra')->nullable();
            $table->enum('group', \Cyaxaress\Setting\Models\Setting::$groups);
            $table->enum('type', \Cyaxaress\Setting\Models\Setting::$types);
            $table->enum('access', \Cyaxaress\Setting\Models\Setting::$accesses);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
