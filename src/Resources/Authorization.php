<?php

namespace Dalmolin\ERede\Resources;

use Dalmolin\ERede\Exceptions\ERedeException;

class Authorization extends Resource
{
    protected $fillable = [
		'Ano',
		'Mes',
		'Cvc2',
		'Nrcartao',
		'Portador',
		'NumPedido',
		'Origem',
		'Parcelas',
		'Recorrente',
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
		$response = $this->call('GetAuthorizedCredit', $this->attributes)
						 ->GetAuthorizedCreditResult;
		# $this->config->debugLastRequest();
		switch ($response->CodRet) {
			case '00':
				return $response;
				break;

			default:
				throw new ERedeException((string) $response->Msgret, (int) $response->CodRet);
		}
    }
}
