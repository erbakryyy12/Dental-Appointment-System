<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;

class Dentist extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID', 'dentistSpeciality', 'dentistImage', 
    ];


    // Specify the custom primary key column name
    protected $primaryKey = 'dentistID';

    // Define the table associated with the model
    protected $table = 'dentists';
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'dentistID');
    }
}

