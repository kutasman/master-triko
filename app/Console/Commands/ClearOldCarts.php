<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class ClearOldCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:clean-up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old carts from DB';

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
    	DB::table('carts')
	        ->where('updated_at', '<',Carbon::now()->subHour(2))
		    ->where('ordered', 0)
	        ->delete();

    	$this->comment('Cart cleared up');

    }
}
