<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function daysUntilDueDate()
{
    $dueDate = \Carbon\Carbon::createFromFormat('Y-m-d', $this->due_date);
    return $dueDate->diffInDays(\Carbon\Carbon::now());
}
protected $fillable = [
    'title',
    'description',
    'due_date',
    '_token',
];


}

