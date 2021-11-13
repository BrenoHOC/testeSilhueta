<?php

namespace App\Http\Controllers;

use App\Http\Service\SilhuetaService;

/**
 * @OA\Info(title="API para teste de Silhueta", version="0.1")
 * @OA\Put  (
 *     path="/silhueta",
 *     summary="Verifica a quantidade de copos de água para cobrir toda a silhueta",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="raw",
 *             @OA\Schema(
 *                 type="object",
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="Retorna com a quantidade. Cada linha representa o total de copos de água por silhueta"),
 *     @OA\Response(response="404", description="Necessário enviar os dados da(s) silhueta(s)")
 * )
 */
class SilhuetaController extends Controller
{
    public function update()
    {
        $handle = fopen("php://input", "r");
        
        if(!$handle) response()->json("É necessário enviar os dados da silhueta", 404);
        
        $dataSilhueta = array();
        
        while (($line = fgets($handle)) !== false) {

            $dataSilhueta[] = trim($line);
        }
        
        fclose($handle);
        
        $silhuetaService = new SilhuetaService();

        $returnSilhueta = $silhuetaService->verifySilhuetas($dataSilhueta);
        
        foreach($returnSilhueta as $value ) {
            echo $value . PHP_EOL;
        }
    }
}

