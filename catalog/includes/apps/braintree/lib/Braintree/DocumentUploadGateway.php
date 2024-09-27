<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Braintree;

/**
 * Braintree DisputeGateway module
 * Creates and manages Braintree Disputes.
 */
class DocumentUploadGateway
{
    private Gateway $_gateway;

    private Configuration $_config;

    private Http $_http;

    /**
     * @param Gateway $gateway
     */
    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_config->assertHasAccessTokenOrKeys();
        $this->_http = new Http($gateway->config);
    }

    /* public class methods */

    /**
     * Accepts a dispute, given a dispute ID.
     *
     * @param mixed $params
     */
    public function create($params)
    {
        Util::verifyKeys(self::createSignature(), $params);

        $file = $params['file'];

        if (!\is_resource($file)) {
            throw new \InvalidArgumentException('file must be a stream resource');
        }

        $payload = [
            'document_upload[kind]' => $params['kind'],
        ];
        $path = $this->_config->merchantPath().'/document_uploads/';
        $response = $this->_http->postMultipart($path, $payload, $file);

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        if (isset($response['documentUpload'])) {
            $documentUpload = DocumentUpload::factory($response['documentUpload']);

            return new Result\Successful($documentUpload);
        }
    }

    public static function createSignature()
    {
        return [
            'file', 'kind',
        ];
    }
}
