<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_memberships', function (Blueprint $table) {
            $table->integer('points')->default(0)->change();
            $table->string('ktp_num');
            $table->string('born_location');
            $table->date('born_date');
            $table->string('nickname');
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female']);
            $table->enum('religion', ['konghucu', 'buddha', 'islam', 'katolik', 'protestan', 'other']);
            $table->enum('size', ['s', 'm', 'l', 'xl', 'xxl', 'xxxl']);
            $table->longText('address');
            $table->string('city');
            $table->string('province');
            $table->string('police_num');
            $table->string('type');
            $table->string('color');
            $table->string('year_production');

            $table->foreignId('chapter_id');
            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('photo_car');
            $table->string('photo_identity');
            $table->string('photo_license');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_memberships', function (Blueprint $table) {
            //
        });
    }
}
