<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    protected $fillable = ['sender_id', 'receiver_id','product_id'];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }
    
        public function sender() {
            return $this->belongsTo(User::class, 'sender_id');
        }
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'conversation_id')->latest();
    }
}
