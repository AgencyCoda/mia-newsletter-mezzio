<?php

namespace Mia\Newsletter\Handler\MiaNewsletter;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/mia_newsletter/save",
 *     summary="MiaNewsletter Save",
 *     tags={"MiaNewsletter"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/MiaNewsletter")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaNewsletter")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class SaveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->firstname = $this->getParam($request, 'firstname', '');
        $item->lastname = $this->getParam($request, 'lastname', '');
        $item->email = $this->getParam($request, 'email', '');
        $item->phone = $this->getParam($request, 'phone', '');
        $item->data_extra = $this->getParam($request, 'data_extra', '');
        $item->status = intval($this->getParam($request, 'status', ''));
        
        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \App\Model\MiaNewsletter
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Get Item ID
        $itemId = $this->getParam($request, 'id', '');
        // Verify exist param
        if($itemId == ''){
            return new \Mia\Newsletter\Model\MiaNewsletter();
        }
        // Buscar si existe el item en la DB
        $item = \Mia\Newsletter\Model\MiaNewsletter::find($itemId);
        // verificar si existe
        if($item === null){
            return new \Mia\Newsletter\Model\MiaNewsletter();
        }
        // Devolvemos item para editar
        return $item;
    }
}