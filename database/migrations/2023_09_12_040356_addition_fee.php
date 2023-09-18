<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addition_fee', function (Blueprint $table) {
            $table->id();
            $table->foreign('addition_fee_type_id')->references('id')->on('addition_fee_type');
            $table->bigInteger('addition_fee_type_id');
            $table->double('amount');
            $table->text('description');
            $table->string('time');
            $table->integer('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addition_fee');
    }
}
