<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Seeder;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('_token')->nullable();
            $table->timestamp('due_date');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('tasks');
    }
}

class AddTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Auth::user(); // Merr përdoruesin aktual të autentikuar

        DB::table('tasks')->insert([
            'title' => 'dsd',
            'description' => 'sdsd',
            'due_date' => '2023-06-10',
            'user_id' => $user->id, // Vendos ID e përdoruesit aktual si user_id
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
