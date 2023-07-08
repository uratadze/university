<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUniversityCollective extends Model
{
    use HasFactory;

    protected $table = 'group_university_collectives';

    protected $fillable = [
        'group_id',
        'university_collective_id'
    ];
}
