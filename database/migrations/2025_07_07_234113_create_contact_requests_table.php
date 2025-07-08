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
       Schema::create('contact_requests', function (Blueprint $table) {
    $table->id();

    // à quel bien porte la demande ?
    $table->foreignId('property_id')
          ->constrained()
          ->onDelete('cascade');

    // champs du formulaire
    $table->string('last_name');
    $table->string('first_name');
    $table->string('email');
    $table->string('phone',30);
    $table->enum('subject',['infos','dossier','rdv','appel']);
    $table->text('message');

    // suivi de traitement (draft : « en_cours » par défaut)
    $table->enum('status',['en_cours','traitée','en_attente'])
          ->default('en_cours');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
