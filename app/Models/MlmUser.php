<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlmUser extends Model
{
    protected $table = 'mlm_users';

    protected $fillable = [
        'id', 'user_name', 'track_id', 'first_name', 'last_name', 
        'father_name', 'email', 'phone', 'password', 'dob', 'sex',
        'address', 'pincode', 'gstin', 'state', 'district',
        'bank_name', 'branch_name', 'account_type', 'account_number',
        'account_holder_name', 'ifsc_code', 'nominee_name',
        'nominee_relation', 'profile_update_count',
        'profile_photo_path', 'transaction_password',
        'sponsor_id', 'membership_type', 'is_active', 'is_deleted',
        'created_at', 'updated_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'dob' => 'date',
        'created_at' => 'datetime',
    ];

    // Sponsor relationship
    public function sponsor()
    {
        return $this->belongsTo(MlmUser::class, 'sponsor_id');
    }
}