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
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('branding_id')->nullable();
            $table->string('business_name');
            $table->text('description')->nullable();
            $table->string('industry')->nullable();
            $table->string('contact_person_name');
            $table->string('contact_person_role')->nullable();
            $table->string('reference_prefix')->nullable();
            $table->string('company_registration')->nullable();
            $table->string('rendering_service')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('cell_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('email')->unique();
            $table->string('website_url')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('banking_details_id')->nullable();
            $table->json('custom_fields')->nullable();
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->foreign('branding_id')->references('id')->on('brandings')->onDelete('set null');
            $table->foreign('banking_details_id')->references('id')->on('banking_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
