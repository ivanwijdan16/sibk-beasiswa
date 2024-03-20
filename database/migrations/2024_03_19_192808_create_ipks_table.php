<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ipk;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ipks', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->double('ipk');
            $table->timestamps();
        });

        ipk::create([
            'nim' => '21102072',
            'ipk' => 2.4
        ]);

        ipk::create([
            'nim' => '21102073',
            'ipk' => 3.4
        ]);

        ipk::create([
            'nim' => '21102074',
            'ipk' => 3.2
        ]);

        ipk::create([
            'nim' => '21102075',
            'ipk' => 2.2
        ]);

        ipk::create([
            'nim' => '21102076',
            'ipk' => 2.9
        ]);

    }


    public function down(): void
    {
        Schema::dropIfExists('ipks');
    }
};