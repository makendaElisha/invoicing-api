<?php

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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->string('organization_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_last_name')->nullable();
            $table->string('business_type');
            $table->string('service_rendered');
            $table->string('company_registration')->nullable();
            $table->string('reference_prefix');
            $table->unsignedBigInteger('address_id');
            $table->string('cell_number');
            $table->string('telephone_number');
            $table->string('vat_number');
            $table->string('email')->unique();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
