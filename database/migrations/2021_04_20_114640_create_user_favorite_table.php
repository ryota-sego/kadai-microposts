<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('micropost_id');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('micropost_id')->references('id')->on('microposts')->onDelete('cascade');

            // user_idとfollow_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'micropost_id']);
        });
    }

    public function down()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign('favorites_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('favorites_micropost_id_foreign');
            $table->dropColumn('micropost_id');
            
        });
    }
}
