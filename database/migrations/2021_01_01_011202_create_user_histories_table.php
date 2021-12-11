<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\UserLog\Models\LogManager;
use TheBachtiarz\UserLog\UserLogInterface;

class CreateUserHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(tbuserlogconfig('user_class'))->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(LogManager::class)->nullable()->constrained()->nullOnDelete();
            $table->text('history');
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
        Schema::dropIfExists('user_histories');
    }
}