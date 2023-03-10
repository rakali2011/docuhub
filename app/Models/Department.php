<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_departments')->wherePivot('department_id', '=', $this->id)->get();
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'department_user', 'department_id', 'user_id');
    }
    public function assinged_users()
    {
        return $this->belongsToMany(User::class, 'department_user')->wherePivot('department_id', '=', $this->id)->get();
    }
    public function assinged_users_array()
    {
        $User = $this->belongsToMany(User::class, 'department_user')->wherePivot('department_id', '=', $this->id)->pluck('departments.id');
        return json_decode(json_encode($User), true);
    }
}
