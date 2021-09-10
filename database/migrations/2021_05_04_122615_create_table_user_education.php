<?php

use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUserEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user_education', function (Blueprint $table) {
            $table->id();
            $table->string("gpa",10);
            $table->string("nim",20);
            $table->date("date_start"); // tgl mulai pendidikan
            $table->date("date_end"); // tgl akhir pendidikan
            $table->bigInteger("degree_id")->unsigned()->nullable();
            $table->foreign('degree_id')->references('id')->on('table_user_education_degree');

            $table->bigInteger("school_id")->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('table_school');

            $table->bigInteger("user_id")->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('table_user');

            $table->bigInteger("major_id")->unsigned()->nullable();
            $table->foreign('major_id')->references('id')->on('table_user_education_major');
        });

        $factory = new Factory();
        DB::table('table_user_education')->insert(array_map(fn($i)=>[
            "gpa"=>$factory->create('id_ID')->randomFloat(1,2,3),
            "nim"=>$factory->create('id_ID')->randomNumber(9),
            "date_start"=>$factory->create('id_ID')->dateTimeBetween('-'.random_int(2,5).' years'),
            "date_end"=>$factory->create('id_ID')->dateTimeBetween('-'.random_int(0,2).' years', 'now'),
            "degree_id"=>$i,
            "school_id"=>$i,
            "user_id"=>$i,
            "major_id"=>$i,
        ],[1,2]));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user_education');
    }
}
