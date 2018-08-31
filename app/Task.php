<?php
namespace App;

use App\Model;

class Task extends Model
{

    protected $fillable = [

        'name',
        'dueDate',
        'status',
        'responsible_id',
        'user_id'

    ];
}
