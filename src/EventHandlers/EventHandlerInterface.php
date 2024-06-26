<?php

declare(strict_types=1);

namespace HydrogenpayAfrica\EventHandlers;

// Prevent direct access to this class
//defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Implement this interface to set triggers for transaction event on Hydrogen Gateway.
 * An event can be triggered when a initializes a transaction, When a
 * transaction is successful, failed, requeried and when a requery fails.
 *
 * @author Olufemi Olanipekun <iolufemi@ymail.com>
 *
 * @version 1.0
 */

interface EventHandlerInterface
{
    /**
     * This is called only when a transaction is successful
     *
     * @param object $transactionData This is the transaction data as returned from the Hydrogenpay payment gateway
     * */
    public function onSuccessful(object $transactionData): void;

    /**
     * This is called only when a transaction failed
     *
     * @param object $transactionData This is the transaction data as returned from the Hydrogenpay payment gateway
     * */
    public function onFailure(object $transactionData): void;

    /**
     * This is called when a transaction is requeryed from the payment gateway
     *
     * @param string $transactionReference This is the transaction reference as returned from the payment gateway
     * */
    public function onRequery(string $transactionReference): void;

    /**
     * This is called a transaction requery returns with an error
     *
     * @param string $requeryResponse This is the error response gotten from the payment gateway requery call
     * */
    public function onRequeryError(string $requeryResponse): void;

    /**
     * This is called when a transaction is canceled by the user
     *
     * @param string $transactionReference This is the transaction reference as returned from the payment gateway
     * */
    public function onCancel(string $transactionReference): void;

    /**
     * This is called when a transaction doesn't return with a success or a failure response.
     *
     * @param string $transactionReference This is the transaction reference as returned from the payment gateway
     *
     * @data object $data This is the data returned from the requery call.
     * */
    public function onTimeout(string $transactionReference, $data): void;
}
