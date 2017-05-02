<?php

namespace Dalmolin\ERede\Resources;

class Authorization extends Resource
{
    protected $fillable = [
	'ANO',
	'MÊS',
	'CVC2',
	'NRCARTAO',
	'PORTADOR',
	'FILIACAO',
	'NUMPEDIDO',
	'ORIGEM',
	'PARCELAS',
	'RECORRENTE',
	'SENHA',
	'TOTAL',
	'TRANSACAO',
    ];

    protected $attributes = [
        'RECORRENTE' => '0',
	'ORIGEM'     => '01',
    	'TRANSACAO'  => '74',
    ];

    public function execute()
    {
	$this->call('GetAuthorizedCredit', $this->attributes);
    }
}
