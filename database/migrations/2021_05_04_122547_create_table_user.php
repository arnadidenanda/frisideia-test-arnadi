<?php

use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("phone", 255);
            $table->string("email", 255);
            $table->string("nim", 255);
        });

        $factory = new Factory();
        DB::table('table_user')->insert(array_map(fn()=>[
            "name"=>$factory->create('id_ID')->name(),
            "phone"=>$factory->create('id_ID')->phoneNumber,
            "email"=>$factory->create('id_ID')->email,
            "nim"=>$factory->create('id_ID')->randomNumber(9)
        ],[1,2,3,4,5]));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user');
    }
}
