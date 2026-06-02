<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AttachCategoryProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attach:category-products';

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
        $subCategories = Category::whereNotNull('parent_id')->get();

        foreach ($subCategories as $subCategory) {

            $productIds = DB::table('product_subcategories')
                ->where('subcategory_id', $subCategory->id)
                ->pluck('product_id');

            foreach ($productIds as $productId) {

                DB::table('product_category')->updateOrInsert([
                    'category_id' => $subCategory->parent_id,
                    'product_id' => $productId,
                ]);
            }
        }

        $this->info('Products attached to parent categories successfully.');
    }
}
