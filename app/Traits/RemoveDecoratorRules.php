<?php 

namespace App\Traits;

trait RemoveDecoratorRules
{
    
    /**
     * Funcion que remueve decoradores de un array de Rules
     * 
     * @param array $shema 
     * @param array $removeDecorator
     * 
     * @return array 
    */

    function removeRules(array $shema = [], array $removeDecorator = []) : array {

        foreach ($shema as $key => $rules) {

            foreach ($removeDecorator as $value) {
                
                if( in_array($value, $rules) ){
                    $position = array_search($rules, $rules);

                    unset($rules[$position]);
                }
            }
      
            $shema[$key] = $rules;
        }

        return $shema;
    }
}