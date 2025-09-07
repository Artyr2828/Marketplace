<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Carts;
class DeleteOldCartItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-cart-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $deleted = Carts::where('updated_at', '<', now()->subMinute(5))->delete();
     $this->info("Количество удаленных корзин: " . $deleted);
    }
}
