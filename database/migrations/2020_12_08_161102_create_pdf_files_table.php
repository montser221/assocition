<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
        Schema::create('pdf_files', function (Blueprint $table) {
            $table->id('fileId');
            $table->string('fileTitle');
            $table->string('pdfFile')->nullable();
            $table->string('imageFile')->nullable();
            $table->tinyInteger('fileStatus')->default(0);
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
        Schema::dropIfExists('pdf_files');
    }
}
