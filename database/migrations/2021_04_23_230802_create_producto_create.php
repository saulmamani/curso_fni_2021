<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique()->comment("codigo AAA-00");
            $table->string('nombre')->comment("nombre del producto");
            $table->text('descripcion')->nullable()->comment("descripcion de producto");
            $table->decimal('precio', 10, 2)->default(0.0);
            $table->string("url_imagen")->nullable()->comment("direccion de la imagen del producto");
            $table->integer("like")->default(0)->nullable();
            $table->integer("dislike")->default(0)->nullable();
        
            //relationships
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade')
                    ->on('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
