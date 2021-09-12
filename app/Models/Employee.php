<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'firstName',
        'lastName',
        'email',
        'phone'
    ];

    public function company(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function getFullNameAttribute(){
        return $this->firstName.' '.$this->lastName;
    }
}
