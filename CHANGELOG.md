# CHANGELOG

## 3.0.1: Dockerised dev environment

* setup Github Actions
* changed tooling from scripts to Makefile
* installed phpstan as a dev depdendency
* installed swiss-knife as a dev depdendency
* installed rector as a dev depdendency
* upgraded PHP CS fixer to v2.19.3
* dockerized for local development

## 3.0.0: PHP 7.2 requirement, PHP 8 and phpspec 7 support

* dropped support for PHP <7.2
* added support for PHP 8
* added support for phpspec 7

## 2.0.0-alpha1, 2.0.0-alpha2: PHP 7

* dropped support for PHP < 7

## 1.0.3: Updated dependencies

* added support to PHP 7

## 1.0.2: Fluent interfaces

* added fluent interface to addTemplatePath

## 1.0.1: Removed unused namesapce autoloading

* removed Config from namespace autoloading

## 1.0.0: TwigTemplateEngine extraction

* extracted TwigTemplateEngine in its own package

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
