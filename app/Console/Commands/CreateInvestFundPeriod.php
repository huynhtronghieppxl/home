<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateInvestFundPeriod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_invest_fund_period';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = DB::table('invest_fund_period')->latest()->first();
        DB::table('invest_fund_period')->insert([
            'time' => date('m/Y'),
            'begin' => $data->begin + $data->amount,
            'real_amount' => $data->begin + $data->amount,
        ]);
    }
}
