<?php

namespace Dalmolin\ERede\Resources;

use Dalmolin\ERede\Exceptions\ERedeException;

class Capture extends Resource
{
    protected $fillable = [
		'Data',
		'NumAutor',
		'NumSqn',
		'Tid',
		'Total',
    ];

    protected $attributes = [
        'Recorrente' => '0',
		'Origem'     => '01',
    	'Transacao'  => '74',
    ];

    public function execute()
    {
		$response = $this->call('ConfirmTxnTID', $this->attributes)
						 ->ConfirmTxnTIDResult;

		switch ($response->CodRet) {
			case '00':
				return $response;
				break;

			default:
				throw new ERedeException((string) $response->Msgret, (int) $response->CodRet);
		}
    }
}
