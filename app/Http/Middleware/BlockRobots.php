<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockRobots
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Liste des user-agents de robots connus
        $knownRobots = [
            'Googlebot',
            'Bingbot',
            'YandexBot',
            'DuckDuckBot',
            'Baiduspider',
            'Sogou',
            'Yahoo! Slurp',
            'Aolbot',
            'Alexa',
            'Cobweb',
            'Technorati',
            'Pingdom',
            'Yandex',
            'Baidu',
            'Sogou',
            'Crawlera',
            'Semrush',
            'Ahrefs',
            // 'Moz',
            'SEOProfiler',
            'DeepCrawl',
            'Sitebulb',
            'GTmetrix',
            'WebPageTest',
            'Pingdom',
            'Uptrends',
            'Monitis',
            'StatusCake',
            'New Relic',
            'Datadog',
            'Grafana',
            'Prometheus',
            'InfluxDB',
            'Elasticsearch',
            'Kibana',
            'Splunk',
            'ArcSight',
            'SIEM',
            'SOAR',
            'XDR',
            'NDR',
            'EDR',
            'MDR',
            'UEBA',
            'SIEM',
            'SOAR',
            'XDR',
            'NDR',
            'EDR',
            'MDR',
            'UEBA',
        ];

        // Vérifier si le user-agent est un robot
        $userAgent = $request->header('User-Agent');
        if ($this->isRobot($userAgent, $knownRobots)) {
            abort(403, "L'accès aux robots est interdit.");
        }

        return $next($request);
    }

    private function isRobot($userAgent, $knownRobots)
    {
        foreach ($knownRobots as $robot) {
            if (stripos($userAgent, $robot) !== false) {
                return true; // Le user-agent correspond à un robot connu
            }
        }
        return false; // Le user-agent n'est pas un robot connu
    }
}
