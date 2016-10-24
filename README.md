Bootstrap Checkbox Bundle
=========================

This is just simple wrapping bundle for [Bootstrap Checkbox](https://github.com/vsn4ik/bootstrap-checkbox).

Minimal Requirements
--------------------
* php 5.6
* symfony 2.3
* twig 1.0

Instalation
-----------

1. Add to composer requirements

```bash
composer require eloar/bootstrap-checkbox-bundle
```

2. Register bundle in Your AppKernel

```php
<?php
//..
public function registerBundles()
{
    $bundles = array(
        // ...
        new ITChaos\Bundle\BootstrapCheckboxBundle\BootstrapCheckboxBundle()
        // ...
    );
    return $bundles;
}
```

3. Add bundle js resources to assetic

```yaml
assetic:
    bundles:
        - BootstrapCheckboxBundle
```

4. Add asset to your layout 

```twig
{% javascripts
    '@BootstrapCheckboxBundle'
%}
<script type="text/javascript" src="{{ asset_url }}"></script>
```

Usage
-----

Bundle provides you with new form type ```BootstrapCheckboxType``` which descends from regular Symfonys ```CheckboxType```. It has same usage but is rendered next to label instead inside (as in most
Bootstrap bundles). All properties for _bootstrap checkbox_ from ```vsn4ik/bootstrap-checkbox``` are exposed by ```BootstrapCheckboxType``` as described in wrapped plugins documnetation
available here:
[BootstrapCheckbox documentation](https://vsn4ik.github.io/bootstrap-checkbox/)

The main difference is expanding parameter names containing ```cls``` to ```class```.
