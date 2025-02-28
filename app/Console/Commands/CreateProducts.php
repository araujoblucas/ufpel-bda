<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class CreateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-products {quantity}';

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
        $quantity = (int) $this->argument('quantity');

        if ($quantity <= 0) {
            $this->error("O número de produtos deve ser maior que zero.");
            return;
        }

        $this->info("Creating {$quantity} products...");

        $this->withProgressBar(range(1, $quantity), function () {
            Product::factory()->create();
        });

        $this->newLine();
        $this->info("All done!");
    }

}
