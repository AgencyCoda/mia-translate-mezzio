<?php

namespace Mia\Translate\Handler;

use Mia\Core\Request\MiaRequestHandler;
use Mia\Translate\Repository\MIATranslateRepository;

/**
 * Description of ListHandler
 * 
 * @OA\Get(
 *     path="/mia-translate/list",
 *     summary="Get all translations",
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MIATranslate")
 *     )
 * )
 *
 * @author matiascamiletti
 */
class ListHandler extends MiaRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Configurar query
        $configure = new \Mia\Database\Query\Configure($this, $request);
        // Obtenemos información
        $rows = MIATranslateRepository::fetchByConfigure($configure);
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($rows->toArray());
    }
}