<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $xmlData = $request->getContent();
            $validator = Validator::make(['xml_data' => $xmlData], [
                'xml_data' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            if (!$this->validateBasicAuth($request)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $this->processXmlData($xmlData);

            return response()->json(['message' => 'Request saved successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Invalid XML data', 'errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function validateBasicAuth(Request $request)
    {
        $credentials = $request->header('Authorization');
        return ($credentials === 'Basic ' . base64_encode('Roman:Rashevskaya20123'));
    }

    /**
     * @throws Exception
     */
    protected function processXmlData($xmlData)
    {
        try {
            $xml = new SimpleXMLElement($xmlData);
            DB::table('items')->insert([
                'uuid' => (string)$xml->uuid,
                'name' => (string)$xml->name,
                'amount' => (int)$xml->amount,
                'price' => (float)$xml->price,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error processing XML data: ' . $e->getMessage());
        }
    }
}
