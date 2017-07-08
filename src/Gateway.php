<?php

namespace Omnipay\InterKassa;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway for InterKassa Shop Cart Interface.
 * http://interkassa.com/.
 */
class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'InterKassa';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters()
    {
        return [
            'endpoint' => 'https://sci.interkassa.com/',
            'signAlgorithm' => 'md5',
            'currency' => 'UAH',
            'testMode' => false,
        ];
    }

    /**
     * Returns the endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    /**
     * Sets the endpoint.
     *
     * Default value is `https://sci.interkassa.com/`.
     *
     * @param string $endpoint
     * @return self
     */
    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    /**
     * Returns the merchant purse.
     *
     * @return string
     */
    public function getCheckoutId()
    {
        return $this->getParameter('checkoutId');
    }

    /**
     * Sets the merchant purse.
     *
     * @param string $value Merchant purse.
     * @return self
     */
    public function setCheckoutId($value)
    {
        return $this->setParameter('checkoutId', $value);
    }

    /**
     * Returns the sign algorithm.
     *
     * @return string
     */
    public function getSignAlgorithm()
    {
        return $this->getParameter('signAlgorithm');
    }

    /**
     * Sets the sign algorithm.
     *
     * Available options: `md5`, `sha256`, `rsa`.
     * Default value is `md5`.
     *
     * @param string $value Sign algorithm.
     * @return self
     */
    public function setSignAlgorithm($value)
    {
        $value = strtolower($value);
        if (!in_array($value, ['md5', 'sha256', 'rsa'])) {
            throw new InvalidRequestException("'$value' is incorect sign algorithm.");
        }
        return $this->setParameter('signAlgorithm', strtolower($value));
    }

    /**
     * Returns the sign key.
     *
     * @return string
     */
    public function getSignKey()
    {
        return $this->getParameter('signKey');
    }

    /**
     * Sets the sign key.
     *
     * @param string $value Sign key.
     * @return self
     */
    public function setSignKey($value)
    {
        return $this->setParameter('signKey', $value);
    }

    /**
     * Returns the test key.
     *
     * @return string
     */
    public function getTestKey()
    {
        return $this->getParameter('testKey');
    }

    /**
     * Sets the test key.
     *
     * @param string $value Test key.
     * @return self
     */
    public function setTestKey($value)
    {
        return $this->setParameter('testKey', $value);
    }

    /**
     * Sets currency.
     *
     * Available options: `UAH`, `USD`, `EUR`.
     * Default value is `UAH`.
     *
     * @param string $value Currency.
     * @return self
     */
    public function setCurrency($value)
    {
        $value = strtoupper($value);
        if (!in_array($value, ['UAH', 'USD', 'EUR'])) {
            throw new InvalidRequestException("'$value' is incorect currency.");
        }
        return $this->setParameter('currency', $value);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\InterKassa\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\InterKassa\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\InterKassa\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\InterKassa\Message\CompletePurchaseRequest', $parameters);
    }
}
