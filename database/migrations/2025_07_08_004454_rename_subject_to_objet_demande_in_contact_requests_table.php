<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ATTENTION : pour pouvoir renommer une colonne enum/string,
     * assurez‑vous d’avoir la librairie doctrine/dbal :
     *   composer require doctrine/dbal
     */

    public function up(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            // 1. renommer la colonne "subject" -> "objet_demande"
            $table->renameColumn('subject', 'objet_demande');

            // 2. mettre à jour l'énum si besoin
            //    (MySQL 8+ accepte le changement direct)
            $table->enum('objet_demande', ['infos','dossier','rdv','appel'])
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            // rollback inverse
            $table->renameColumn('objet_demande', 'subject');
            $table->enum('subject', ['infos','dossier','rdv','appel'])
                  ->change();
        });
    }
};
