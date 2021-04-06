<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'invoice_number',
            'invoice_date',
            'due_date',
            'product',
            'section_id',
            'amount_collection',
            'discount',
            'amount_commission',
            'value_vat',
            'rate_vat',
            'total',
            'status',
            'value_status',
            'note',
            'user',
            'payment_date'
    ];

    public function section(){
        return $this->belongsTo(sections::class);
    }
}
