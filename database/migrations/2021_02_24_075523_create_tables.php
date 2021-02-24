<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login', 32);
            $table->text('password');
            $table->string('email');
            $table->text('photo');
            $table->integer('shop_id')->nullable();
            $table->integer('name_id');
            $table->integer('surname_id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('district_id');
            $table->integer('street_id');
            $table->integer('house_id');
            $table->integer('status_id')->nullable();
            $table->integer('ban_id')->nullable();
            $table->dateTime('registration_time');
            $table->dateTime('email_verified_at')->nullable();
            $table->rememberToken();
        });

        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
        });

        Schema::create('surnames', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->integer('user_id');
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->integer('user_id');
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->integer('user_id');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->integer('user_id');
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->integer('user_id');
        });

        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->integer('user_id');
        });

        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('house');
            $table->integer('user_id');
        });

        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->text('shop_description');
            $table->integer('user_id');
            $table->integer('shop_rating')->nullable();
            $table->integer('showing');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
        });

        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory');
            $table->integer('category_id');
        });

        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('lot_name');
            $table->text('lot_description');
            $table->integer('price');
            $table->integer('count');
            $table->integer('lot_rating')->nullable();
            $table->integer('shop_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('showing');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->integer('review_rating')->nullable();
            $table->integer('user_id');
            $table->integer('lot_id');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
