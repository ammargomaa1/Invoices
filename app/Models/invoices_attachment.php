<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_attachment extends Model
{
    use HasFactory;
    protected $table = 'invoices_attachment';
    protected $gaurded = [];
    protected $fillable = [
                   'file_name',
                    'invoice_number',
                    'created_by',
                    'invoice_id'
    ];
}
