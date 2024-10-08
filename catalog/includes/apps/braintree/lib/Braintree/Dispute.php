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
 * Creates an instance of Dispute as returned from a transaction.
 *
 * @property string                                    $amount
 * @property \DateTime                                 $createdAt
 * @property string                                    $currencyIsoCode
 * @property string                                    $disbursementDate
 * @property \Braintree\Dispute\EvidenceDetails        $evidence
 * @property string                                    $graphQLId
 * @property string                                    $id
 * @property string                                    $kind
 * @property string                                    $merchantAccountId
 * @property string                                    $originalDisputeId
 * @property string                                    $processorComments
 * @property string                                    $reason
 * @property string                                    $reasonCode
 * @property string                                    $reasonDescription
 * @property \DateTime                                 $receivedDate
 * @property string                                    $referenceNumber
 * @property \DateTime                                 $replyByDate
 * @property string                                    $status
 * @property \Braintree\Dispute\StatusHistoryDetails[] $statusHistory
 * @property \Braintree\Dispute\TransactionDetails     $transaction
 * @property \Braintree\Dispute\TransactionDetails     $transactionDetails
 * @property \DateTime                                 $updatedAt
 */
class Dispute extends Base
{
    /* Dispute Status */
    public const ACCEPTED = 'accepted';
    public const DISPUTED = 'disputed';
    public const EXPIRED = 'expired';
    public const OPEN = 'open';
    public const WON = 'won';
    public const LOST = 'lost';

    /* Dispute Reason */
    public const CANCELLED_RECURRING_TRANSACTION = 'cancelled_recurring_transaction';
    public const CREDIT_NOT_PROCESSED = 'credit_not_processed';
    public const DUPLICATE = 'duplicate';
    public const FRAUD = 'fraud';
    public const GENERAL = 'general';
    public const INVALID_ACCOUNT = 'invalid_account';
    public const NOT_RECOGNIZED = 'not_recognized';
    public const PRODUCT_NOT_RECEIVED = 'product_not_received';
    public const PRODUCT_UNSATISFACTORY = 'product_unsatisfactory';
    public const TRANSACTION_AMOUNT_DIFFERS = 'transaction_amount_differs';
    public const RETRIEVAL = 'retrieval';

    /* Dispute Kind */
    public const CHARGEBACK = 'chargeback';
    public const PRE_ARBITRATION = 'pre_arbitration';
    protected $_attributes = [];

    public function __toString()
    {
        $display = [
            'amount', 'reason', 'status',
            'replyByDate', 'receivedDate', 'currencyIsoCode',
        ];

        $displayAttributes = [];

        foreach ($display as $attrib) {
            $displayAttributes[$attrib] = $this->{$attrib};
        }

        return __CLASS__.'['.
                Util::attributesToString($displayAttributes).']';
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /**
     * Accepts a dispute, given a dispute ID.
     *
     * @param string $id
     */
    public static function accept($id)
    {
        return Configuration::gateway()->dispute()->accept($id);
    }

    /**
     * Adds file evidence to a dispute, given a dispute ID and a document ID.
     *
     * @param string $disputeId
     * @param string $documentIdOrRequest
     */
    public static function addFileEvidence($disputeId, $documentIdOrRequest)
    {
        return Configuration::gateway()->dispute()->addFileEvidence($disputeId, $documentIdOrRequest);
    }

    /**
     * Adds text evidence to a dispute, given a dispute ID and content.
     *
     * @param string       $id
     * @param mixed|string $contentOrRequest If a string, $contentOrRequest is the text-based content for the dispute evidence.
     *                                       Alternatively, the second argument can also be an array containing:
     *                                       string $content The text-based content for the dispute evidence, and
     *                                       string $category The category for this piece of evidence
     *                                       Note: (optional) string $tag parameter is deprecated, use $category instead.
     *
     *  Example: https://developers.braintreepayments.com/reference/request/dispute/add-text-evidence/php#submitting-categorized-evidence
     */
    public static function addTextEvidence($id, $contentOrRequest)
    {
        return Configuration::gateway()->dispute()->addTextEvidence($id, $contentOrRequest);
    }

    /**
     * Finalize a dispute, given a dispute ID.
     *
     * @param string $id
     */
    public static function finalize($id)
    {
        return Configuration::gateway()->dispute()->finalize($id);
    }

    /**
     * Find a dispute, given a dispute ID.
     *
     * @param string $id
     */
    public static function find($id)
    {
        return Configuration::gateway()->dispute()->find($id);
    }

    /**
     * Remove evidence from a dispute, given a dispute ID and evidence ID.
     *
     * @param string $disputeId
     * @param string $evidenceId
     */
    public static function removeEvidence($disputeId, $evidenceId)
    {
        return Configuration::gateway()->dispute()->removeEvidence($disputeId, $evidenceId);
    }

    /**
     * Search for Disputes, given a DisputeSearch query.
     *
     * @param DisputeSearch $query
     */
    public static function search($query)
    {
        return Configuration::gateway()->dispute()->search($query);
    }
    // RETRIEVAL for kind already defined under Dispute Reason

    protected function _initialize($disputeAttribs): void
    {
        $this->_attributes = $disputeAttribs;

        if (isset($disputeAttribs['transaction'])) {
            $transactionDetails = new Dispute\TransactionDetails($disputeAttribs['transaction']);
            $this->_set('transactionDetails', $transactionDetails);
            $this->_set('transaction', $transactionDetails);
        }

        if (isset($disputeAttribs['evidence'])) {
            $evidenceArray = array_map(static function ($evidence) {
                return new Dispute\EvidenceDetails($evidence);
            }, $disputeAttribs['evidence']);
            $this->_set('evidence', $evidenceArray);
        }

        if (isset($disputeAttribs['statusHistory'])) {
            $statusHistoryArray = array_map(static function ($statusHistory) {
                return new Dispute\StatusHistoryDetails($statusHistory);
            }, $disputeAttribs['statusHistory']);
            $this->_set('statusHistory', $statusHistoryArray);
        }

        if (isset($disputeAttribs['transaction'])) {
            $this->_set(
                'transaction',
                new Dispute\TransactionDetails($disputeAttribs['transaction']),
            );
        }
    }
}
