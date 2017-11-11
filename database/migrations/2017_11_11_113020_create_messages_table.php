<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_email');
            $table->string('from_name')->nullable()->default(null);
            $table->string('reply_to');
            $table->dateTime('receive_date');
            $table->text('html_body')->nullable()->default(null);
            $table->text('text_body')->nullable()->default(null);
            $table->string('message_id');
            $table->string('mailbox_hash');
            $table->text('source')->nullable()->default(null);
            $table->unsignedInteger('address_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('messages');
    }
}
