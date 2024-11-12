<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;
    protected $table = 'CARRINHO_ITEM';
    protected $primaryKey = ['USUARIO_ID', 'PRODUTO_ID'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'USUARIO_ID',
        'PRODUTO_ID',
        'ITEM_QTD'
    ];
    public function Produto()
    {
        return $this->hasMany(Produto::class, 'PRODUTO_ID', 'PRODUTO_ID');
    }

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class, 'USUARIO_ID', 'USUARIO_ID');
    }
}
