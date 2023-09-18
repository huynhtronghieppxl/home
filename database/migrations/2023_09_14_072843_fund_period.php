<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FundPeriod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_period', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->double('begin')->default(0);
            $table->double('receipt')->default(0);
            $table->double('payment')->default(0);
            $table->double('reserve_fund')->default(0);
            $table->double('invest_fund')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('fund_period');
    }
}
