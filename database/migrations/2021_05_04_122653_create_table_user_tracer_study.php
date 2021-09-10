<?php

use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUserTracerStudy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user_tracer_study', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("school_id")->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('table_school');
            $table->string("name", 255);
            $table->string("description", 255);
            $table->date("target_start");
            $table->date("target_end");
            $table->date("publication_start");
            $table->date("publication_end");
        });

        $factory = new Factory();
        DB::table('table_user_tracer_study')->insert(array_map(fn($i)=>[
            "school_id"=>$i,
            "name"=>$factory->create('id_ID')->name,
            "description"=>$factory->create('id_ID')->text(255),
            "target_start"=>$factory->create('id_ID')->dateTimeBetween('-'.random_int(0,3).' years'),
            "target_end"=>$factory->create('id_ID')->dateTimeBetween('now','+'.random_int(0,5).' years'),
            "publication_start"=>$factory->create('id_ID')->dateTimeBetween('now', 'now'),
            "publication_end"=>$factory->create('id_ID')->dateTimeBetween('now', '+'.random_int(0,3).' months')
        ],[1,2]));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user_tracer_study');
    }
}
