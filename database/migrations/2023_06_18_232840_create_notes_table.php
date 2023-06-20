<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use App\Models\User;

    class CreateNotesTable extends Migration
    {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Shto kolonën 'user_id'
            $table->timestamps();

            // Shto lidhjen e jashtme (foreign key) me tabelën 'users'
            $table->foreign('user_id')->references('id')->on('users');
        });
    }   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
    }

    class AddNoteSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $user = User::find(auth()->user()->id); // Get the currently authenticated user
            
            DB::table('notes')->insert([
                'title' => 'dsd',
                'description' => 'sdsd',
                'photo' => 'null',
            ]);
        }
    }
