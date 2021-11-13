<?php

use App\Http\Service\SilhuetaService;

class SilhuetaServiceTest extends TestCase
{
    /**
     * @dataProvider dataSilhuetaProvider
     */
    public function testAdd($data, $expected): void
    {
        $silhuetaService = new SilhuetaService();
        $returnSilhueta = $silhuetaService->verifySilhuetas($data);
        
        foreach($returnSilhueta as $key => $value ) {
            $this->assertEquals($expected[$key], $value);
        }
    }
    
    public function dataSilhuetaProvider()
    {
        $data = [
            2,
            9, "5 4 3 2 1 2 3 4 5",
            30, "7 10 2 5 13 3 4 10 5 9 4 2 6 5 18 6 8 6 15 4 20 4 8 9 5 21 4 7 19 2",
            1,
            10
        ];
        
        $resulted = [16, 214, 0];
        
        return array(
            array($data, $resulted),
        );
    }
}
