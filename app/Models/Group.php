<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'group_address_id'
    ];

    public function universityCollectives(): BelongsToMany
    {
        return $this->belongsToMany(
            UniversityCollective::class,
            'group_university_collectives',
            'group_id',
            'university_collective_id'
        );
    }

    public function groupWithCollective($groupId=null)
    {
        $group = $groupId ? $this->where('id', $groupId) : $this;

        return $group->with('universityCollectives')->get();
    }

    public function collectiveAdd($groupId, $collectiveIds)
    {
        $group = $this->find($groupId);
        $collective = UniversityCollective::whereIn('id', $collectiveIds)->get();

        return empty($group->universityCollectives()->sync($collective->pluck('id'), false)['attached']);
    }
}
