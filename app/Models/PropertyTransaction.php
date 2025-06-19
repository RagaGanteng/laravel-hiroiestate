<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTransaction extends Model
{
    protected $fillable = [
        'property_type_id',
        'agent_id',
        'customer_name',
        'customer_email',
        'status',
        'date',
        'notes'
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}


