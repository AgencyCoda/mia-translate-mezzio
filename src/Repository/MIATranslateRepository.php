<?php namespace Mia\Translate\Repository;

use \Illuminate\Database\Capsule\Manager as DB;
use Mia\Translate\Model\MIATranslate;

class MIATranslateRepository
{
    /**
     * 
     * @param \Mia\Database\Query\Configure $configure
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure)
    {
        $query = MIATranslate::select('mia_translate.*');
        
        if(!$configure->hasOrder()){
            $query->orderByRaw('id DESC');
        }
        $search = $configure->getSearch();
        if($search != ''){
            $values = $search . '|' . implode('|', explode(' ', $search));
            $query->whereRaw('(section REGEXP ? OR path REGEXP ? OR name REGEXP ?)', [$values, $values, $values]);
        }
        
        // Procesar parametros
        $configure->run($query);

        return $query->paginate($configure->getLimit(), ['*'], 'page', $configure->getPage());
    }
}