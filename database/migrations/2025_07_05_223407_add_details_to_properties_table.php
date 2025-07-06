<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            // ─────────── Informations techniques ───────────
            $table->unsignedInteger('surface')->nullable()->after('city');          // m²
            $table->unsignedTinyInteger('nb_pieces')->nullable()->after('surface');
            $table->unsignedTinyInteger('nb_chambres')->nullable()->after('nb_pieces');
            $table->unsignedTinyInteger('nb_sdb')->nullable()->after('nb_chambres');
            $table->unsignedSmallInteger('etage')->nullable()->after('nb_sdb');
            $table->unsignedSmallInteger('annee_construction')->nullable()->after('etage');

            // ─────────── Aspects financiers / contrat ───────────
            $table->enum('contrat', ['vente','location'])->default('vente')->after('type');
            $table->unsignedBigInteger('charges')->nullable()->after('price');      // loyers/charges
            $table->unsignedBigInteger('caution')->nullable()->after('charges');

            // ─────────── Autres ───────────
            $table->boolean('disponibilite')->default(true)->after('description');  // vrai => disponible
            $table->json('equipements')->nullable()->after('disponibilite');        // ex: ["piscine","garage"]
            $table->string('adresse')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'surface','nb_pieces','nb_chambres','nb_sdb','etage','annee_construction',
                'contrat','charges','caution','disponibilite','equipements','adresse'
            ]);
        });
    }
};
