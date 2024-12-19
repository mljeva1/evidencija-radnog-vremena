<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Activity_type;
use App\Models\Company_profile;
use App\Models\Task_status;


class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $table = 'tasks';


    public function activityType()
    {
        return $this->belongsTo(Activity_type::class, 'activity_type_id'); // Primjer relacije prema ActivityType modelu
    }

    public function companyProfile()
    {
        return $this->belongsTo(Company_profile::class, 'company_profile_id');
    }

    public function taskStatus()
    {
        return $this->belongsTo(Task_status::class, 'task_status_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

}
