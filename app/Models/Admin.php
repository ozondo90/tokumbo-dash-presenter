<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable, SoftDeletes;

    protected $gard = 'admin';
    protected $date = ['deleted_at'];
    protected $table = 'admins';
    protected $fillable = ['name','type','vendor_id','mobile','email','password','image','status','email_verified_at'];


    // Belong o relation with vendor personal
    public function vendorPersonal():BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // Belong o relation with vendor business details
    public function vendorBusiness():BelongsTo
    {
        return $this->belongsTo(VendorsBusinessDetail::class, 'vendor_id');
    }

    // Belong o relation with vendor bank details
    public function vendorBank():BelongsTo
    {
        return $this->belongsTo(VendorsBankDetail::class, 'vendor_id');
    }






    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
