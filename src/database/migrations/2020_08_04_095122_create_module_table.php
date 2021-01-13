<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abo_subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lang_id')->nullable();
            $table->string('email');
            $table->integer('subscribe');
            $table->timestamps();
        });

        Schema::create('abo_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lang_id')->nullable();
            $table->longText('text');
            $table->longText('html');
            $table->string('subject');
            $table->string('from_name')->nullable();;
            $table->string('from_email')->nullable();;
            $table->timestamps();
        });

        Schema::create('abo_historys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('template_id')->nullable();
            $table->integer('lang_id')->nullable();
            $table->string('to_email');
            $table->string('to_name')->nullable();;
            $table->string('from_email');
            $table->string('from_name')->nullable();;
            $table->string('subject')->nullable();;
            $table->longText('html');
            $table->timestamp('sended_at')->nullable();
            $table->string('send_info')->nullable();
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
        Schema::drop('abo_subcribers');
        Schema::drop('abo_templates');
        Schema::drop('abo_historys');
    }
}
