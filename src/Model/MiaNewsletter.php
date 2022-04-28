<?php

namespace Mia\Newsletter\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $firstname Description for variable
 * @property mixed $lastname Description for variable
 * @property mixed $email Description for variable
 * @property mixed $phone Description for variable
 * @property mixed $data_extra Description for variable
 * @property mixed $created_at Description for variable
 * @property mixed $updated_at Description for variable
 * @property mixed $deleted Description for variable
 * @property mixed $status Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="firstname",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="lastname",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="email",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="phone",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="data_extra",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="created_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="updated_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="deleted",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="status",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaNewsletter extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_newsletter';
    
    protected $casts = ['data_extra' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    

    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('mia_newsletter.deleted', 0);
        });
    }
}