<?php

namespace Mia\Translate\Model;

/**
 * Description of Model
 * @property int $id Notification ID
 * @property string $title Title of role
 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="section",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="path",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="parent",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="name",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="lang_one",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="lang_two",
 *  type="string",
 *  description=""
 * )
 *
 * @author matiascamiletti
 */
class MIATranslate extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_translate';
}
