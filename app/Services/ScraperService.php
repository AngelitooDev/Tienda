<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Client\ConnectionException;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;

class ScraperService
{
    /**
     * @throws ConnectionException
     */
    public function scrapePrice(string $url): ?float
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
        ])->get($url);

        $contentType = $response->header('Content-Type');

        if (str_contains($contentType, 'application/json')) {
            return $this->parseJson($response->body());
        } elseif (str_contains($contentType, 'application/xml') || str_contains($contentType, 'text/xml')) {
            return $this->parseXml($response->body());
        } else {
            return $this->parseHtml($url);
        }
    }

    private function parseJson(string $body): ?float
    {
        $data = json_decode($body, true);
        return $data['price'] ?? null;
    }

    private function parseXml(string $body): ?float
    {
        $xml = simplexml_load_string($body);
        return $xml->price ? (float)$xml->price : null;
    }

    private function parseHtml(string $url): ?float
    {
        try {
            $client = new Client(['headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            ]]);
            $response = $client->request('GET', $url);
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            // Cambia este selector por el correcto para tu página
            $priceText = $crawler->filter('.product-price, #our_price_display')->first()->text();

            // Elimina caracteres no numericos, separadores de miles y formatea los decimales
            $priceText = preg_replace('/[^0-9,\.]/', '', $priceText);  // Mantiene solo numeros, comas y puntos
            $priceText = str_replace('.', '', $priceText);  // Elimina los puntos de los miles
            $priceText = str_replace(',', '.', $priceText);  // Convierte la coma en punto decimal

            return floatval($priceText);
        } catch (\Exception $e) {
            return null;  // Si hay un error, retorna null
        }
    }
}
