# Omnipay: InterKassa
[InterKassa](https://www.interkassa.com) payment processing driver for the Omnipay PHP payment processing library.

[![Latest Stable Version](https://poser.pugx.org/webtoucher/omnipay-interkassa/v/stable)](https://packagist.org/packages/webtoucher/omnipay-interkassa)
[![Total Downloads](https://poser.pugx.org/webtoucher/omnipay-interkassa/downloads)](https://packagist.org/packages/webtoucher/omnipay-interkassa)
[![Daily Downloads](https://poser.pugx.org/webtoucher/omnipay-interkassa/d/daily)](https://packagist.org/packages/webtoucher/omnipay-interkassa)
[![Latest Unstable Version](https://poser.pugx.org/webtoucher/omnipay-interkassa/v/unstable)](https://packagist.org/packages/webtoucher/omnipay-interkassa)
[![License](https://poser.pugx.org/webtoucher/omnipay-interkassa/license)](https://packagist.org/packages/webtoucher/omnipay-interkassa)

## Installation

The preferred way to install this library is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require webtoucher/omnipay-interkassa "*"
```

or add

```
"webtoucher/omnipay-interkassa": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

The following gateways are provided by this package:

* InterKassa

```php
    $gateway = \Omnipay\Omnipay::create('InterKassa');
    $gateway->setCheckoutId('[CHECKOUT_ID]');
    $gateway->setSignKey('[SIGN_KEY]');
```

The first step is prepairing data and redirecting to InterKassa. This is example of paiment via Privat 24.

```php
    $request = $gateway->purchase([
        'amount' => $amount,
        'currency' => 'UAH',
        'transactionId' => $orderId,
        'description' => "Some description (order $orderId)",
        'interface' => 'web',
        'action' => 'payway',
        'payway' => 'privat24_liqpay_merchant3_uah',
        'returnUrl' => "https://mydomain.com/payment/interkassa/success?order=$orderId",
        'returnMethod' => 'GET',
        'cancelUrl' => 'https://mydomain.com/payment/interkassa/cancel',
        'cancelMethod' => 'GET',
        'notifyUrl' => 'https://mydomain.com/payment/interkassa/notify',
        'notifyMethod' => 'POST',
    ]);
    $response = $request->send();
    if ($response->isRedirect()) {
        $response->redirect();
    }
```

There is the notify request handler.

```php
    $request = $gateway->completePurchase($_POST);
    $response = $request->send();
    $orderId = $response->getTransactionId(); // You can check this order and mark it as paid.
    if ($response->isSuccessful()) {
        // Your handler
    } else {
        // Your handler
    }
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/webtoucher/omnipay-interkassa/issues).