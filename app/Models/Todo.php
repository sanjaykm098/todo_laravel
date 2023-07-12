<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    use HasFactory;

    public $fillable = ['task','info','status'];

    public $table = 'todo';

    public $timestamps = false;

}
