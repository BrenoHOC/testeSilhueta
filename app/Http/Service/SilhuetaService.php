<?php

namespace App\Http\Service;

class SilhuetaService
{
    private $height;
    private $width;
    private $waterCup = 0;
    
    public function verifySilhuetas(array $data): array
    {
        $return = array();
        
        foreach($data as $key => $value) {
            if($key % 2 === 0 && $key > 0) {
                
                $explodeNumbers = explode(" ", $value);
                
                $return[] = $this->buildSilhueta($explodeNumbers);
                
                $this->waterCup = 0;
            }
        }
        
        return $return;
    }
    
    private function buildSilhueta(array $data): int
    {
        $maxs = array_keys($data, max($data));
        
        $biggerIndex = end($maxs);
        
        if($biggerIndex > 0) {
            $arraySlice = array_slice($data, $biggerIndex);
            
            $outputSmaller = array_slice($data, 0, $biggerIndex);
            
            $outputBigger = array_reverse($arraySlice);

            $this->totalOfWaterCup($outputSmaller);
            $this->totalOfWaterCup($outputBigger);

            return $this->waterCup;
        }
        
        return 0;        
    }
    
    private function totalOfWaterCup(array $data): void
    {
        $pointer = $data[0];
        
        foreach($data as $value) {
            if($pointer > $value) {
                $this->waterCup += $pointer - $value;
            } else {
                $pointer = $value;
            }
        }
    }
}