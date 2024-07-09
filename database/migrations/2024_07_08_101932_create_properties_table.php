<?php

// Treba dodati i foreignIdFor za lokaciju ili koji već sistem određivanja lokacije nekretnine

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Type::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('price');
            $table->integer('surface');
            $table->float('lat');
            $table->float('lon');
            $table->integer('rooms')->nullable();
            $table->integer('toilets')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('garage')->nullable();
            $table->integer('furnished')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('lease_duration')->nullable();
            $table->boolean('video_intercom')->nullable();
            $table->boolean('keycard_entry')->nullable();
            $table->boolean('elevator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
