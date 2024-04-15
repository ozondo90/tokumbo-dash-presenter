<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorsBusinessDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $date = ['deleted_at'];
    protected $table = 'vendors_business_details';
    protected $fillable = [
        'vendor_id',
        'shop_name',
        'shop_address',
        'shop_city',
        'shop_state',
        'shop_country',
        'shop_pinCode',
        'shop_mobile',
        'shop_website',
        'address_proof',
        'address_proof_image',
        'business_licence_number',
        'business_registration_number',
        'pan_number',
    ];

    // Belongto relation between vendor and vendor business detail
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

}
