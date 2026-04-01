<?php
declare(strict_types=1);

namespace App\Services\Payments;

// This is a third party class. You can not modify it.
class BitcoinPayment 
{
    public function executePayment(float $amount): string
    {
        $tx = $this->createTransaction($amount);
        $signedTx = $this->signTransaction($tx);
        $txId = $this->broadcastTransaction($signedTx);
        return "Pay done";
    }

    private function createTransaction(float $amount)
    {
        // construir inputs/outputs (UTXO)
    }

    private function signTransaction($tx)
    {
        // firmar con clave privada
    }

    private function broadcastTransaction($signedTx)
    {
        // enviar a la red (node o API)
    }
}