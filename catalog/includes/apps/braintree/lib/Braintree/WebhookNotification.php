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

class WebhookNotification extends Base
{
    public const SUBSCRIPTION_CANCELED = 'subscription_canceled';
    public const SUBSCRIPTION_CHARGED_SUCCESSFULLY = 'subscription_charged_successfully';
    public const SUBSCRIPTION_CHARGED_UNSUCCESSFULLY = 'subscription_charged_unsuccessfully';
    public const SUBSCRIPTION_EXPIRED = 'subscription_expired';
    public const SUBSCRIPTION_TRIAL_ENDED = 'subscription_trial_ended';
    public const SUBSCRIPTION_WENT_ACTIVE = 'subscription_went_active';
    public const SUBSCRIPTION_WENT_PAST_DUE = 'subscription_went_past_due';
    public const SUB_MERCHANT_ACCOUNT_APPROVED = 'sub_merchant_account_approved';
    public const SUB_MERCHANT_ACCOUNT_DECLINED = 'sub_merchant_account_declined';
    public const TRANSACTION_DISBURSED = 'transaction_disbursed';
    public const TRANSACTION_SETTLED = 'transaction_settled';
    public const TRANSACTION_SETTLEMENT_DECLINED = 'transaction_settlement_declined';
    public const DISBURSEMENT_EXCEPTION = 'disbursement_exception';
    public const DISBURSEMENT = 'disbursement';
    public const DISPUTE_OPENED = 'dispute_opened';
    public const DISPUTE_LOST = 'dispute_lost';
    public const DISPUTE_WON = 'dispute_won';
    public const DISPUTE_ACCEPTED = 'dispute_accepted';
    public const DISPUTE_DISPUTED = 'dispute_disputed';
    public const DISPUTE_EXPIRED = 'dispute_expired';
    public const PARTNER_MERCHANT_CONNECTED = 'partner_merchant_connected';
    public const PARTNER_MERCHANT_DISCONNECTED = 'partner_merchant_disconnected';
    public const PARTNER_MERCHANT_DECLINED = 'partner_merchant_declined';
    public const OAUTH_ACCESS_REVOKED = 'oauth_access_revoked';
    public const CHECK = 'check';
    public const ACCOUNT_UPDATER_DAILY_REPORT = 'account_updater_daily_report';
    public const CONNECTED_MERCHANT_STATUS_TRANSITIONED = 'connected_merchant_status_transitioned';
    public const CONNECTED_MERCHANT_PAYPAL_STATUS_CHANGED = 'connected_merchant_paypal_status_changed';
    public const GRANTOR_UPDATED_GRANTED_PAYMENT_METHOD = 'grantor_updated_granted_payment_method';
    public const RECIPIENT_UPDATED_GRANTED_PAYMENT_METHOD = 'recipient_updated_granted_payment_method';
    public const GRANTED_PAYMENT_METHOD_REVOKED = 'granted_payment_method_revoked';
    public const PAYMENT_METHOD_REVOKED_BY_CUSTOMER = 'payment_method_revoked_by_customer';
    public const LOCAL_PAYMENT_COMPLETED = 'local_payment_completed';

    public static function parse($signature, $payload)
    {
        return Configuration::gateway()->webhookNotification()->parse($signature, $payload);
    }

    public static function verify($challenge)
    {
        return Configuration::gateway()->webhookNotification()->verify($challenge);
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    protected function _initialize($attributes): void
    {
        $this->_attributes = $attributes;

        if (!isset($attributes['sourceMerchantId'])) {
            $this->_set('sourceMerchantId', null);
        }

        if (isset($attributes['subject']['apiErrorResponse'])) {
            $wrapperNode = $attributes['subject']['apiErrorResponse'];
        } else {
            $wrapperNode = $attributes['subject'];
        }

        if (isset($wrapperNode['subscription'])) {
            $this->_set('subscription', Subscription::factory($attributes['subject']['subscription']));
        }

        if (isset($wrapperNode['merchantAccount'])) {
            $this->_set('merchantAccount', MerchantAccount::factory($wrapperNode['merchantAccount']));
        }

        if (isset($wrapperNode['transaction'])) {
            $this->_set('transaction', Transaction::factory($wrapperNode['transaction']));
        }

        if (isset($wrapperNode['disbursement'])) {
            $this->_set('disbursement', Disbursement::factory($wrapperNode['disbursement']));
        }

        if (isset($wrapperNode['partnerMerchant'])) {
            $this->_set('partnerMerchant', PartnerMerchant::factory($wrapperNode['partnerMerchant']));
        }

        if (isset($wrapperNode['oauthApplicationRevocation'])) {
            $this->_set('oauthAccessRevocation', OAuthAccessRevocation::factory($wrapperNode['oauthApplicationRevocation']));
        }

        if (isset($wrapperNode['connectedMerchantStatusTransitioned'])) {
            $this->_set('connectedMerchantStatusTransitioned', ConnectedMerchantStatusTransitioned::factory($wrapperNode['connectedMerchantStatusTransitioned']));
        }

        if (isset($wrapperNode['connectedMerchantPaypalStatusChanged'])) {
            $this->_set('connectedMerchantPayPalStatusChanged', ConnectedMerchantPayPalStatusChanged::factory($wrapperNode['connectedMerchantPaypalStatusChanged']));
        }

        if (isset($wrapperNode['dispute'])) {
            $this->_set('dispute', Dispute::factory($wrapperNode['dispute']));
        }

        if (isset($wrapperNode['accountUpdaterDailyReport'])) {
            $this->_set('accountUpdaterDailyReport', AccountUpdaterDailyReport::factory($wrapperNode['accountUpdaterDailyReport']));
        }

        if (isset($wrapperNode['grantedPaymentInstrumentUpdate'])) {
            $this->_set('grantedPaymentInstrumentUpdate', GrantedPaymentInstrumentUpdate::factory($wrapperNode['grantedPaymentInstrumentUpdate']));
        }

        if (\in_array($attributes['kind'], [self::GRANTED_PAYMENT_METHOD_REVOKED, self::PAYMENT_METHOD_REVOKED_BY_CUSTOMER], true)) {
            $this->_set('revokedPaymentMethodMetadata', RevokedPaymentMethodMetadata::factory($wrapperNode));
        }

        if (isset($wrapperNode['localPayment'])) {
            $this->_set('localPaymentCompleted', LocalPaymentCompleted::factory($wrapperNode['localPayment']));
        }

        if (isset($wrapperNode['errors'])) {
            $this->_set('errors', new Error\ValidationErrorCollection($wrapperNode['errors']));
            $this->_set('message', $wrapperNode['message']);
        }
    }
}
