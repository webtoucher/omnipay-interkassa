<?php

namespace Omnipay\InterKassa\Message;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * InterKassa Abstract Request.
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const TEST_PAYWAY = 'test_interkassa_test_xts';

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
     * Returns the method for success return.
     *
     * @return string
     */
    public function getReturnMethod()
    {
        return $this->getParameter('returnMethod');
    }

    /**
     * Sets the method for success return.
     *
     * Available options: `get`, `post`.
     *
     * @param string $value
     * @return self
     */
    public function setReturnMethod($value)
    {
        $value = strtolower($value);
        if (!in_array($value, ['get', 'post'])) {
            throw new InvalidRequestException("'$value' is incorect method.");
        }
        return $this->setParameter('returnMethod', $value);
    }

    /**
     * Returns the method for canceled payment return.
     *
     * @return string
     */
    public function getCancelMethod()
    {
        return $this->getParameter('cancelMethod');
    }

    /**
     * Sets the method for canceled payment return.
     *
     * Available options: `get`, `post`.
     *
     * @param string $value
     * @return self
     */
    public function setCancelMethod($value)
    {
        $value = strtolower($value);
        if (!in_array($value, ['get', 'post'])) {
            throw new InvalidRequestException("'$value' is incorect method.");
        }
        return $this->setParameter('cancelMethod', $value);
    }

    /**
     * Returns the method for request notify.
     *
     * @return string
     */
    public function getNotifyMethod()
    {
        return $this->getParameter('notifyMethod');
    }

    /**
     * Sets the method for request notify.
     *
     * Available options: `get`, `post`.
     *
     * @param string $value
     * @return self
     */
    public function setNotifyMethod($value)
    {
        $value = strtolower($value);
        if (!in_array($value, ['get', 'post'])) {
            throw new InvalidRequestException("'$value' is incorect method.");
        }
        return $this->setParameter('notifyMethod', $value);
    }

    /**
     * Returns payway.
     *
     * @return string
     */
    public function getPayway()
    {
        return $this->getTestMode() ? self::TEST_PAYWAY : $this->getParameter('payway');
    }

    /**
     * Sets payway.
     *
     * @see https://api.interkassa.com/v1/paysystem-input-payway
     * @param string $value Payway.
     * @return self
     */
    public function setPayway($value)
    {
        return $this->setParameter('payway', $value);
    }

    /**
     * Returns action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getParameter('action');
    }

    /**
     * Sets action.
     *
     * Available options:
     *  - `process`: handle process,
     *  - `payways`: payment method,
     *  - `payways_calc`: calculation of payment ways,
     *  - `payway`: payment direction.
     *
     * @param string $value Action.
     * @return self
     */
    public function setAction($value)
    {
        if (!in_array($value, ['process', 'payways', 'payways_calc', 'payway'])) {
            throw new InvalidRequestException("'$value' is incorect action.");
        }
        return $this->setParameter('action', $value);
    }

    /**
     * Returns interface.
     *
     * @return string
     */
    public function getInterface()
    {
        return $this->getParameter('interface');
    }

    /**
     * Sets interface.
     *
     * Available options: `web`, `json`.
     *
     * @param string $value Interface.
     * @return self
     */
    public function setInterface($value)
    {
        if (!in_array($value, ['web', 'json'])) {
            throw new InvalidRequestException("'$value' is incorect interface.");
        }
        return $this->setParameter('interface', $value);
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
     * Calculates sign for the $data.
     *
     * @param array $dataSet
     * @param string $key
     * @return string
     */
    public function calculateSign($data, $signKey)
    {
        unset($data['ik_sign']);
        ksort($data, SORT_STRING);
        array_push($data, $signKey);
        $signAlgorithm = $this->getSignAlgorithm();
        $signString = implode(':', $data);
        return base64_encode(hash($signAlgorithm, $signString, true));
    }
}
