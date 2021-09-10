<?php

use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_school', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("phone", 255);
            $table->string("email", 255);
            $table->string("fax", 255);
            $table->string("address", 255);
            $table->string("website", 255);
            $table->string("logo", 255);
            $table->string("postal_code", 255);
            $table->string("about", 255);
            $table->string("mission", 255);
            $table->string("vision", 255);
        });

        $factory = new Factory();
        DB::table('table_school')->insert(array_map(fn()=>[
            "name"=>$factory->create('id_ID')->name(),
            "phone"=>$factory->create('id_ID')->phoneNumber,
            "email"=>$factory->create('id_ID')->email,
            "fax"=>$factory->create('id_ID')->phoneNumber,
            "address"=>$factory->create('id_ID')->address,
            "website"=>$factory->create('id_ID')->url,
            "logo"=>"media/x.jpg",
            "postal_code"=>$factory->create('id_ID')->postcode,
            "about"=>$factory->create('id_ID')->words(7, true),
            "mission"=>$factory->create('id_ID')->words(20, true),
            "vision"=>$factory->create('id_ID')->words(20, true),
        ],[1,2]));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_school');
    }
}
