<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;

    protected $table = 'PEDIDO_ITEM';
    protected $primaryKey = ['PRODUTO_ID', 'PEDIDO_ID'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['PRODUTO_ID', 'PEDIDO_ID', 'ITEM_QTD', 'ITEM_PRECO'];

    public function Produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID', 'PRODUTO_ID');
    }

    public function Pedido()
    {
        return $this->belongsTo(Pedido::class, 'PEDIDO_ID', 'PEDIDO_ID');
    }
}
