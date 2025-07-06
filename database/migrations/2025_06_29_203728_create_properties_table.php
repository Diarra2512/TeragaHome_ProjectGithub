<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crée la table properties avec toutes les colonnes nécessaires.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Relation : un bien appartient à un utilisateur
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Données du bien
            $table->string('title');                   // ex. : Villa contemporaine
            $table->string('type');                    // villa, appartement, terrain…
            $table->string('city');                    // Dakar, Thiès…
            $table->unsignedBigInteger('price');       // 125000000
            $table->text('description');               // description longue
            $table->string('image')->nullable();       // chemin vers la photo

            $table->timestamps();                      // created_at & updated_at
        });
    }

    /**
     * Supprime la table si on fait un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
