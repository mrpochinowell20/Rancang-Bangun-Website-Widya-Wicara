<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<<< HEAD:database/migrations/2022_06_20_095707_create_company_table.php
class CreateCompanyTable extends Migration
========
class CreateTestimonialsTable extends Migration
>>>>>>>> project-rika:database/migrations/2022_06_12_074502_create_testimonials_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<<< HEAD:database/migrations/2022_06_20_095707_create_company_table.php
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->text("nama");
            $table->text("content");
========
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('job');
            $table->text('testimonial');
            $table->date('date');
>>>>>>>> project-rika:database/migrations/2022_06_12_074502_create_testimonials_table.php
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
<<<<<<<< HEAD:database/migrations/2022_06_20_095707_create_company_table.php
        Schema::dropIfExists('company');
========
        Schema::dropIfExists('testimonials');
>>>>>>>> project-rika:database/migrations/2022_06_12_074502_create_testimonials_table.php
    }
}
