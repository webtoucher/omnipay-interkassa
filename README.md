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
    $gateway->setPurse('[CHECKOUT_ID]');
    $gateway->setSignKey('[SIGN_KEY]');
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