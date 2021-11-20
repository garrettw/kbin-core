<?php declare(strict_types=1);

namespace App\Cardano;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CardanoTransactions
{
    // https://forum.cardano.org/t/how-to-get-started-with-metadata-on-cardano/45111

    public function __construct(
        private string $cardanoWalletUrl,
        private HttpClientInterface $client,
    ) {
    }

    public function create(string $passphrase, string $walletId, string $receiverAddress, float $amount): array
    {
        $amount *= 1000000;
        $amount = explode('.', (string) $amount)[0];

        return $this->client->request(
            'POST',
            "$this->cardanoWalletUrl/wallets/$walletId/transactions",
            [
                'json' => [
                    'passphrase' => $passphrase,
                    'payments'   => [
                        [
                            'address' => $receiverAddress,
                            'amount'  => [
                                'quantity' => (int) $amount,
                                'unit'     => 'lovelace',
                            ],
                        ],
                    ],
                ],
            ]
        )->toArray();
    }
}
