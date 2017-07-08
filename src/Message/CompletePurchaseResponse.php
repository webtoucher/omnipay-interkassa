<?php

namespace Omnipay\InterKassa\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * InterKassa Complete Purchase Response.
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @var CompletePurchaseRequest
     */
    public $request;

    /**
     * @inheritdoc
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        $signKey = $this->request->getTestMode() ? $this->request->getTestKey() : $this->request->getSignKey();
        $signExpected = $this->request->calculateSign($this->data, $signKey);

        if ($this->getCheckoutId() !== $this->request->getCheckoutId()) {
            throw new InvalidResponseException('Wrong checkout ID');
        }

        if ($this->getSign() !== $signExpected) {
            throw new InvalidResponseException("Failed to validate signature: $signExpected");
        }
    }

    /**
     * Whether the payment is successful.
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getState() === 'success';
    }

    /**
     * Returns the checkout ID.
     *
     * @return string
     */
    public function getCheckoutId()
    {
        return $this->data['ik_co_id'];
    }

    /**
     * Returns the sign.
     *
     * @return string
     */
    public function getSign()
    {
        return $this->data['ik_sign'];
    }

    /**
     * Returns the transaction identifier.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data['ik_pm_no'];
    }

    /**
     * @inheritdoc
     */
    public function getTransactionReference()
    {
        return $this->data['ik_inv_id'];
    }

    /**
     * Returns the amount of the payment.
     *
     * @return number
     */
    public function getAmount()
    {
        return $this->data['ik_am'];
    }

    /**
     * Returns the currency of the payment.
     *
     * @return string
     */
    public function getCurrency()
    {
        return strtoupper($this->data['ik_cur']);
    }

    /**
     * Returns the time of request processing.
     *
     * @return string
     */
    public function getTime()
    {
        return $this->data['ik_inv_prc'];
    }

    /**
     * Returns payway.
     *
     * @return string
     */
    public function getPayway()
    {
        return $this->data['ik_pw_via'];
    }

    /**
     * Returns the state of the payment.
     *
     * Possible results:
     *  - `new`: newly created payment,
     *  - `waitAccept`: waits for the payment,
     *  - `process`: the payment is being processed,
     *  - `success`: the payment processed successfully,
     *  - `canceled`: the payment have been canceled,
     *  - `fail`: the payment failed.
     *
     * @return string
     * @see isSuccessful
     */
    public function getState()
    {
        return $this->data['ik_inv_st'];
    }

    public function getDescription()
    {
        return $this->data['ik_desc'];
    }
}
