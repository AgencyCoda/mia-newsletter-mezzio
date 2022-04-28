<?php

namespace Mia\Newsletter\Handler\MiaNewsletter;

use Mia\Core\Exception\MiaException;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia_newsletter/add",
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
class AddHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Fetch email
        $email = $this->getParam($request, 'email', '');
        // Search if exist
        if($email == ''||\Mia\Newsletter\Model\MiaNewsletter::where('email', $email)->first() !== null){
            throw new MiaException('Has already exist!');
        }

        $item = new \Mia\Newsletter\Model\MiaNewsletter();
        $item->firstname = $this->getParam($request, 'firstname', '');
        $item->lastname = $this->getParam($request, 'lastname', '');
        $item->email = $this->getParam($request, 'email', '');
        $item->phone = $this->getParam($request, 'phone', '');
        $item->data_extra = $this->getParam($request, 'data_extra', []);
        $item->status = 0;

        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
}