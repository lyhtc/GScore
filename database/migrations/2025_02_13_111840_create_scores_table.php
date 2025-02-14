<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('sbd')->unique();
            $table->decimal('toan', 4, 2)->nullable();
            $table->decimal('ngu_van', 4, 2)->nullable();
            $table->decimal('ngoai_ngu', 4, 2)->nullable();
            $table->decimal('vat_li', 4, 2)->nullable();
            $table->decimal('hoa_hoc', 4, 2)->nullable();
            $table->decimal('sinh_hoc', 4, 2)->nullable();
            $table->decimal('lich_su', 4, 2)->nullable();
            $table->decimal('dia_li', 4, 2)->nullable();
            $table->decimal('gdcd', 4, 2)->nullable();
            $table->string('ma_ngoai_ngu')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
