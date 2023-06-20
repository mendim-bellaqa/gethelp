<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
            $table->timestamp('due_date');
            $table->time('due_time')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('status', ['Proces', 'Kryer', 'Refuzuar'])->default('Proces');
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
        $user = User::find(auth()->user()->id); // Get the currently authenticated user
        
        DB::table('tasks')->insert([
            'title' => 'dsd',
            'description' => 'sdsd',
            'due_date' => '2023-06-10',
            'due_time' => '12:00:00', // Set the due time
            'user_id' => $user->id, // Set the user_id to the currently authenticated user's ID
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'Proces',
        ]);
    }
}
