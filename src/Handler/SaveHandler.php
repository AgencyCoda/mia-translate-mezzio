<?php

namespace Mia\Translate\Handler;

use Mia\Core\Request\MiaRequestHandler;
use Mia\Translate\Model\MIATranslate;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/mia-translate/save",
 *     summary="Translate Save",
 *     tags={"Translate"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/MIATranslate")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MIATranslate")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class SaveHandler extends MiaRequestHandler
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
        $item->section = $this->getParam($request, 'setion', '');
        $item->path = $this->getParam($request, 'path', '');
        $item->parent = $this->getParam($request, 'parent', '');
        $item->name = $this->getParam($request, 'name', '');
        $item->lang_one = $this->getParam($request, 'lang_one', '');
        $item->lang_two = $this->getParam($request, 'lang_two', '');
        $item->lang_three = $this->getParam($request, 'lang_three', '');
        $item->lang_four = $this->getParam($request, 'lang_four', '');
        $item->lang_five = $this->getParam($request, 'lang_five', '');
        
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
     * @return \App\Model\CommunityMessage
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        $name = $this->getParam($request, 'name', '');
        $parent = $this->getParam($request, 'parent', '');
        // Buscar si existe el item en la DB
        $item = MIATranslate::find($itemId);
        // verificar si existe
        if($item === null){
            $item = MIATranslate::where('name', $name)->where('parent', $parent)->first();
        }
        // verificar si existe
        if($item === null){
            return new MIATranslate();
        }
        // Devolvemos item para editar
        return $item;
    }
}