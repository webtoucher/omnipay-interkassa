<?php

namespace Omnipay\InterKassa\Message;

/**
 * Class PurchaseRequest.
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('checkoutId', 'amount', 'currency', 'description', 'transactionId');

        $return = [
            'ik_co_id' => $this->getCheckoutId(),
            'ik_am' => $this->getAmount(),
            'ik_pm_no' => $this->getTransactionId(),
            'ik_desc' => $this->getDescription(),
            'ik_cur' => $this->getCurrency(),
        ];

        if ($successUrl = $this->getReturnUrl()) {
            $return['ik_pnd_u'] = $successUrl;
            $return['ik_suc_u'] = $successUrl;
            if ($successMethod = $this->getReturnMethod()) {
                $return['ik_pnd_m'] = $successMethod;
                $return['ik_suc_m'] = $successMethod;
            }
        }

        if ($failUrl = $this->getCancelUrl()) {
            $return['ik_fal_u'] = $failUrl;
            if ($failMethod = $this->getCancelMethod()) {
                $return['ik_fal_m'] = $failUrl;
            }
        }

        if ($notifyUrl = $this->getNotifyUrl()) {
            $return['ik_ia_u'] = $notifyUrl;
            if ($notifyMethod = $this->getNotifyMethod()) {
                $return['ik_ia_m'] = $notifyMethod;
            }
        }

        if ($action = $this->getAction()) {
            $return['ik_act'] = $action;
        }

        if ($payway = $this->getPayway()) {
            $return['ik_pw_via'] = $payway;
        }

        if ($interface = $this->getInterface()) {
            $return['ik_int'] = $interface;
        }

        if ($signKey = $this->getSignKey()) {
            $return['ik_sign'] = $this->calculateSign($return, $signKey);
        }

        return $return;
    }

    /**
     * @inheritdoc
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
