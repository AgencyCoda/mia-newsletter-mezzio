<?php

namespace Mia\Newsletter\Handler;

use Mia\Core\Exception\MiaException;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia_newsletter/fetch/{id}",
 *     summary="MiaNewsletter Fetch",
 *     tags={"MiaNewsletter"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaNewsletter")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 *
 * @author matiascamiletti
 */
class FetchHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Verify has withs in query
        $withs = $this->getParam($request, 'withs', '');
        if($withs != ''){
            // Convert to array
            $with = explode(',', $withs);
            // Search item in DB
            $item = \Mia\Newsletter\Model\MiaNewsletter::with($with)->where('id', $itemId)->first();
        } else {
            // Buscar si existe el tour en la DB
            $item = \Mia\Newsletter\Model\MiaNewsletter::find($itemId);
        }
        // verificar si existe
        if($item === null){
            throw new MiaException('not exist');
        }
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
}