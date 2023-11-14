<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Str;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create product into database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'sku' => Str::upper(Str::random(8)),
            'name' => 'Product ' . Str::random(6),
        ];
        Product::create($data);
        // logger('Command create production');
        return 0;
    }
}
