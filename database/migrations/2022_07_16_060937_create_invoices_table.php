<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('from_address');
            $table->text('to_address');
            $table->float('sub_total_without_tax', 8, 2);
            $table->float('sub_total_with_tax', 8, 2);
            $table->enum('discount_type', ['percentage', 'amount']);
            $table->float('discount_value', 8, 2);
            $table->float('discount_amount', 8, 2);
            $table->float('grand_total', 8, 2);
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
        Schema::dropIfExists('invoices');
    }
}
