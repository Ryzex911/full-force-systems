<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Voeg accountgegevens toe aan gebruikers.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Particulier of zakelijk
            $table->string('account_type')
                ->default('particulier');

            // Bedrijfsnaam (alleen voor zakelijke accounts)
            $table->string('company_name')
                ->nullable();

        });
    }

    /**
     * Verwijder de toegevoegde kolommen.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'account_type',
                'company_name'
            ]);

        });
    }
};
