<?php

namespace Omnipay\InterKassa\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * InterKassa Purchase Response.
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        // Always returns FALSE, because InterKassa always needs redirect
        return false;
    }

    /**
     * @inheritdoc
     */
    public function isRedirect()
    {
        // Always returns TRUE, because InterKassa always needs redirect
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getRedirectUrl()
    {
        return $this->getRequest()->getEndpoint();
    }

    /**
     * @inheritdoc
     */
    public function getRedirectMethod()
    {
        // Always returns `POST` for InterKassa
        return 'POST';
    }

    /**
     * @inheritdoc
     */
    public function getRedirectData()
    {
        return $this->data;
    }
}
