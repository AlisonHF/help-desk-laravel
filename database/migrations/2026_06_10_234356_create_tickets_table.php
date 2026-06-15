<?php

use App\Enums\TicketStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300);
            $table->text('description');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('technician_id')->nullable()->constrained('users');
            $table->string('status', 50)->default(TicketStatus::Aberto->value);
            $table->timestamp('completed_in')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
