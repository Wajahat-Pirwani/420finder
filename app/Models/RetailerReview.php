<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RetailerReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'retailer_id',
        'product_id',
        'dispensary_product_id',
        'description',
        'rating'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }
    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'retailer_id');
    }
}
