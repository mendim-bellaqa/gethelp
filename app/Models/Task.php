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
        '_token',
    ];

    public function daysUntilDueDate()
    {
        $dueDate = Carbon::createFromFormat('Y-m-d', $this->due_date);
        return $dueDate->diffInDays(Carbon::now());
    }
}
