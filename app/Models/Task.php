<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'title',
        'description',
        'due_date',
        'user_id',
        'status',
        '_token',
    ];
    

    public function daysUntilDueDate()
    {
        $dueDate = Carbon::createFromFormat('Y-m-d', $this->due_date);
        return $dueDate->diffInDays(Carbon::now());
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
