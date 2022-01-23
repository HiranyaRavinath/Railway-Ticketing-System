<?php

use App\Models\TrainTickets;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('class', array_keys(TrainTickets::$classes))->default(1);
            $table->double('price');
            $table->integer('start');
            $table->integer('end');
            $table->integer('train');
            $table->tinyInteger('isforeigner')->default(1);
            $table->enum('status', array_keys(TrainTickets::$status))->default(1);
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
        Schema::dropIfExists('train_tickets');
    }
}
