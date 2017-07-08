<?php

namespace Omnipay\InterKassa\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * InterKassa Complete Purchase Request.
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     * @return array Request data.
     */
    public function getData()
    {
        if ($this->getTestMode()) {
            $this->validate('testKey');
        } else {
            $this->validate('signKey');
        }

        $result = [];
        $vars = array_merge($this->httpRequest->query->all(), $this->httpRequest->request->all());
        foreach ($vars as $key => $parameter) {
            if (strpos($key, 'ik_') === 0) {
                $result[$key] = $parameter;
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
