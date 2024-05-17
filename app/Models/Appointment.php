<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Dentist;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'dentistID',
        'appointmentDate',
        'appointmentTime',
        'medicalPrescription',
    ];
    

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'appointmentID';

    protected $casts = [
        'appointmentTime' => 'string', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
    
    public function dentist()
    {
        return $this->belongsTo(Dentist::class, 'dentistID');
    }

}
