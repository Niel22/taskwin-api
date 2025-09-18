<?php

use App\Models\User;
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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'promoter_id')->nullable()->constrained()->nullOnDelete();
            $table->string('location')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('device')->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('age')->nullable();
            $table->string('profession')->nullable();
            $table->string('gender')->nullable();
            $table->string('proof')->nullable();
            $table->string('telegram')->nullable();
            $table->string('payment_code')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
