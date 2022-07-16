<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceItem;

class Invoice extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'slug', 'detail'
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot() {
  
        parent::boot();
  
        
        static::created(function($invoice) {           
            //$invoice->sub_total_without_tax = 
    
        });
  
        
        static::updated(function($item) {  
            /*
                Write Logic Here
            */    
  
            //Log::info('Updated event call: '.$item);
        });
  
        
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

}
