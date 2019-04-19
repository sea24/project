<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OrderSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '挂售回收';

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
     * @return mixed
     */
    public function handle()
    {
        //
        DB::beginTransaction();
        try {
            $order = Order::where([['type', '=', 3], ['status', '!=', 3], ['pay_status' , '=', 1]])
                ->whereDate('updated_at', '<=', date('Y-m-d', strtotime('-5 days')))
                ->get();
            foreach ($order as $item) {
                $item->sends();
                DB::commit();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }
        return true;
    }
}
