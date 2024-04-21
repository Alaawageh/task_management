<?php

use App\Enums\PriorityEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority',[PriorityEnum::Low, PriorityEnum::Middle, PriorityEnum::High])->default(PriorityEnum::High);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status',[StatusEnum::Pending ,StatusEnum::in_progress ,StatusEnum::Done])->default(StatusEnum::Pending);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
