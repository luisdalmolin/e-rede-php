<?php

namespace Dalmolin\ERede\Resources;

class Authorization extends Resource
{
    protected $fillable = [
		'Ano',
		'Mes',
		'Cvc2',
		'Nrcartao',
		'Portador',
		'Filiacao',
		'NumPedido',
		'Origem',
		'Parcelas',
		'Recorrente',
		'Senha',
		'Total',
		'Transacao',
    ];

    protected $attributes = [
        'Recorrente' => '0',
		'Origem'     => '01',
    	'Transacao'  => '74',
    ];

    public function execute()
    {
		$response = $this->call('GetAuthorizedCredit', $this->attributes);

		dd($response);
    }
}
