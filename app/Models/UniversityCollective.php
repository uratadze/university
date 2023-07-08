<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityCollective extends Model
{
    use HasFactory;

    protected $table = 'university_collectives';

    const STUDENT = 1;
    const TEACHER = 2;

    protected $fillable = [
        'type_id',
        'first_name',
        'last_name',
        'personal_id',
        'emails',
        'date_of_birth'
    ];

    protected $casts = [
        'emails' => 'object'
    ];

    public function updateUniversityCollective($collectiveType, $personId, $studentData)
    {
        $collective = $this->where('type_id', $collectiveType)
            ->find($personId);
        $collective->update($studentData);

        return $collective;
    }

    public function searchCollective($collectiveType, $searchQuery)
    {
        return $this
            ->where('type_id', $collectiveType)
            ->where(function ($collective) use ($searchQuery){
                $collective
                    ->where('first_name', 'LIKE', "%$searchQuery%")
                    ->orWhere('last_name', 'LIKE', "%$searchQuery%")
                    ->orWhere('personal_id', 'LIKE', "%$searchQuery%")
                    ->orWhere('date_of_birth', 'LIKE', "%$searchQuery%");
            })
            ->get();
    }

    public function deleteUniversityCollective($collectiveType, $collectiveId)
    {
        return $this->where('type_id', $collectiveType)->find($collectiveId)->delete();
    }
}
