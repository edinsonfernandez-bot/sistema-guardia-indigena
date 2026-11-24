<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('certificados', function (Blueprint $table) {
            if (!Schema::hasColumn('certificados', 'codigo_verificacion')) {
                $table->string('codigo_verificacion')->unique()->after('id');
            }
            if (!Schema::hasColumn('certificados', 'tipo')) {
                $table->string('tipo', 100)->after('codigo_verificacion');
            }
            if (!Schema::hasColumn('certificados', 'fecha_emision')) {
                $table->date('fecha_emision')->after('tipo');
            }
            if (!Schema::hasColumn('certificados', 'observaciones')) {
                $table->text('observaciones')->nullable()->after('fecha_emision');
            }
            if (!Schema::hasColumn('certificados', 'guardia_id')) {
                $table->foreignId('guardia_id')->constrained('guardias')->onDelete('cascade');
            }
            if (!Schema::hasColumn('certificados', 'user_id')) {
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'observaciones']);
        });
    }
};