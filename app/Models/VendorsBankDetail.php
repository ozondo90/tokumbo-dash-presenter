<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorsBankDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $date = ['deleted_at'];
    protected $table = 'vendors_bank_details';
    protected $fillable = [
       'vendor_id',
       'account_holder_name',
       'account_number',
       'bank_name',
       'bank_ifsc_code',
    ];


    // Belongto relation between vendor and vendor bank detail
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
