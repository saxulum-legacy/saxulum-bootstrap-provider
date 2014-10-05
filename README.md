saxulum-bootstrap-provider
==========================

**works with plain silex-php**

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-bootstrap-provider.png?branch=master)](https://travis-ci.org/saxulum/saxulum-bootstrap-provider)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-bootstrap-provider/downloads.png)](https://packagist.org/packages/saxulum/saxulum-bootstrap-provider)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-bootstrap-provider/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-bootstrap-provider)

Provides a twitter bootstrap integration based on [BraincraftedBootstrapBundle][1]


Requirements
------------

 * PHP 5.3+
 * Pimple >=2.1,<4
 * Symfony/Form ~2.3
 * Twig ~1.2


Installation
------------

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-bootstrap-provider][2].

In different to the original [BraincraftedBootstrapBundle][1], it does NOT PROVIDE any assetic integration.
There is an [assetic-provider][3] available, to load assets (css/js/less/scss).
There is an [collection.js][4] available.


Usage
-----

Please use the documentation of the original [BraincraftedBootstrapBundle][1].


Configuration
-------------

You don't need to change it, every value, got its default.

 * `bootstrap.template_dir`: path to the templates
 * `bootstrap.icon_prefix`: icon prefix
 * `bootstrap.icon_tag`: icon tag


License
-------

MIT, see LICENSE. Check [BraincraftedBootstrapBundle][1]


Copyright
---------
* Dominik Zogg <dominik.zogg@gmail.com>
* Florian Eckerstorfer <florian@eckerstorfer.co> ([BraincraftedBootstrapBundle][1])


[1]: http://bootstrap.braincrafted.com/
[2]: https://packagist.org/packages/saxulum/saxulum-bootstrap-provider
[3]: https://github.com/saxulum/saxulum-assetic-twig-provider
[4]: https://github.com/saxulum/saxulum-collection-js