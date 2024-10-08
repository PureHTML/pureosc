<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Braintree;

/**
 * Upload documents to Braintree in exchange for a DocumentUpload object.
 *
 * An example of creating a document upload with all available fields:
 *      $result = Braintree\DocumentUpload::create([
 *          "kind" => Braintree\DocumentUpload::EVIDENCE_DOCUMENT,
 *          "file" => $pngFile
 *      ]);
 *
 * For more information on DocumentUploads, see https://developers.braintreepayments.com/reference/request/document_upload/create
 *
 * @property string    $contentType
 * @property \DateTime $expiresAt
 * @property string    $id
 * @property string    $kind
 * @property string    $name
 * @property int       $size
 */
class DocumentUpload extends Base
{
    /* DocumentUpload Kind */
    public const EVIDENCE_DOCUMENT = 'evidence_document';

    /**
     * Creates a DocumentUpload object.
     *
     * @param mixed $params
     * @param kind The kind of document
     * @param file The open file to upload
     *
     * @throws \InvalidArgumentException if the params are not expected
     */
    public static function create($params)
    {
        return Configuration::gateway()->documentUpload()->create($params);
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    protected function _initialize($documentUploadAttribs): void
    {
        $this->_attributes = $documentUploadAttribs;
    }
}
