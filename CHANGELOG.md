# CHANGELOG

## 1.0.0-rc5: Allowed template over loading

* added `PrettyPrinter#addTemplatePath`
* added `TemplateEngine#addPath`

## 1.0.0-rc4: Fixed TwigTemplateEngine

* added missing return statement

## 1.0.0-rc3: TemplateEngine

* created TwigTemplateEngine
* created TemplateEngine
* renamed PrettyPrinterStrategy to CodeGenerator

> **BC breaks**:
>
> * `PrettyPrinter`'s constructor now takes a `TemplateEngine`.

## 1.0.0-rc2: Locate

* created Locate to simplify template localization

## 1.0.0-rc1: Import

* imported pretty printer from [memio/memio](http://github.com/memio/memio) v1.0.0-rc10
