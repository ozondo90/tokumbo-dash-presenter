<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    protected $date = ['deleted_at'];
    protected $table = 'vendors';
    protected $fillable = ['name','address','city','state','country','pin_code','mobile','email','status'];


    // Hasone relation between vendor and vendor business detail
    public function vendorBusinessDetail(): HasOne
    {
        return $this->hasOne(VendorsBusinessDetail::class);
    }

    // Hasone relation between vendor and vendor bank detail
    public function vendorBankDetail(): HasOne
    {
        return $this->hasOne(VendorsBankDetail::class);
    }
}
