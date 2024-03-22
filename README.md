# twill-croppa

Add links to croppa, twill cms, croppa config, default package croppa config, twill cms media docs ...

Use Croppa as media rendering service in Twill applications.

Learn more about Croppa:

Learn more about Twill CMS:

## About this package

![](https://img.shields.io/github/license/C2H6-383/twill-croppa.svg)
![](https://img.shields.io/github/realese/C2H6-383/twill-croppa.svg)
![](https://img.shields.io/github/forks/C2H6-383/twill-croppa.svg)
![](https://img.shields.io/github/stars/C2H6-383/twill-croppa.svg)
![](https://img.shields.io/github/issues/C2H6-383/twill-croppa.svg)
![](https://img.shields.io/github/issues-pr/C2H6-383/twill-croppa.svg)
![](https://img.shields.io/github/commits-since/C2H6-383/twill-croppa.svg)

<!-- ![](https://img.shields.io/github/actions/workflow/status/C2H6-383/twill-croppa/:workflow.svg) -->

![](https://img.shields.io/packagist/v/c2h6/twill-croppa.svg)
![](https://img.shields.io/packagist/dt/c2h6/twill-croppa.svg)

This package provides an easy-to-use integration of the Croppa image library into Twill CMS to use as a media and image rendering provider.
When switching to the provided rendering service, the advantages of Croppa can be used in your Twill application. In addition, a few other utils for working with media in the context of Twill are offered.

### Features

- image rendering service for interfacing with the twill media library
- easy configuration of all plugin settings
- some croppa preconfiguration
- automatic crops deletion on media removal
- traits for media detaching on model deletion

## Prequesites/Versioning

Use the following table to find the right version for your Laravel/Twill/Croppa version to fit your environment.

All package releases are available via GitHub and packagist releases to download.

| Package Version         | Croppa Version | Twill version | Laravel Version |
| ----------------------- | -------------- | ------------- | --------------- |
| 1.x _(Current Version)_ | 6.x            | 3.x           | 10.x            |

## Requirements

This package only depends on Twill CMS and Croppa and their dependencies.

## Installation

Installation of this library is easy to do via `Composer`:

```bash
composer require c2h6/twill-croppa
```

Package discovery is automatically done by the Laravel Framework.

You should already set up the storage linking for storing your media files. For further information check the Twill CMS Docs.

## Usage

TODO

## Configuration Options

If you want to change configuration options of this plugin, you can either create a new configuration file called `twillcroppa.php` in the Laravel config directory or publish the default configuration file with the command `php artisan vendor:publish --tag=twillcroppa-config`. A list with a detailed description of the configuration options is displayed below.

This library automatically configures some croppa parameters. To further refine the Croppa settings, please refer to the configuration options of Croppa stated in the Croppa documentation.

| config option | Default | description |
| ------------- | ------- | ----------- |
|               |         |             |
|               |         |             |

## Extra: Media Detaching on Model deletion

When dealing with Media Models when working with Twill there is often the burden to detach any media when deleting a model. Otherwise, there are some dangling references remaining and any of these media files can never be deleted from the application, as twill registers some usage cases.

To speed this process up, this package contains a few PHP traits to automatically detach any media relations on deleting or force deleting a given model:

`C2H6\TwillCroppa\Traits\DetachMediaOnForceDelete::class` for automatically deleting relations on model force deletion and
`C2H6\TwillCroppa\Traits\DetachMediaOnDelete::class` for automatically deleting relations on model (soft) deletion.

For normal use cases, only the first one should be needed, as Twill always uses soft deletes per default. On model deletion, the model is put in a Trash section, where a recovery is possible. Only on removal from this Trash section, a media detachment should be done.

### Usage

To use these traits just add them to any of your models and they should work out of the box.

## Package Development

- clone or fork this GitHub repository and download it to your dev environment
- install all composer dependencies with `composer install`
- run tests with the command `composer test`
- just submit issues and pull requests
