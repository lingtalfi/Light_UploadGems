Ling/Light_UploadGems
================
2020-04-13 --> 2020-04-14




Table of contents
===========

- [LightUploadGemsException](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Exception/LightUploadGemsException.md) &ndash; The LightUploadGemsException class.
- [GemHelper](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper.md) &ndash; The GemHelper class.
    - [GemHelper::__construct](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/__construct.md) &ndash; Builds the GemHelper instance.
    - [GemHelper::setConfig](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setConfig.md) &ndash; Sets the config for this gemHelper.
    - [GemHelper::setContainer](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setContainer.md) &ndash; Sets the container.
    - [GemHelper::setFilename](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setFilename.md) &ndash; Sets the filename.
    - [GemHelper::setTags](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setTags.md) &ndash; Sets an array of tags that will be used in the applyCopies method.
    - [GemHelper::applyNameTransform](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyNameTransform.md) &ndash; the transformed file name.
    - [GemHelper::applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyValidation.md) &ndash; true if they all pass, or returns the error message returned by the first failing constraint otherwise.
    - [GemHelper::applyCopies](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyCopies.md) &ndash; Applies the copy configuration to the given path, and returns the path of the desired copy.
    - [GemHelper::apply](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/apply.md) &ndash; and returns the output of the applyCopies method.
    - [GemHelper::getConfig](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/getConfig.md) &ndash; Returns the config array attached to this instance.
- [GemHelperInterface](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface.md) &ndash; The GemHelperInterface interface.
    - [GemHelperInterface::setFilename](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/setFilename.md) &ndash; Sets the filename.
    - [GemHelperInterface::setTags](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/setTags.md) &ndash; Sets an array of tags that will be used in the applyCopies method.
    - [GemHelperInterface::apply](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/apply.md) &ndash; and returns the output of the applyCopies method.
    - [GemHelperInterface::getConfig](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/getConfig.md) &ndash; Returns the config array attached to this instance.
    - [GemHelperInterface::applyNameTransform](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyNameTransform.md) &ndash; the transformed file name.
    - [GemHelperInterface::applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyValidation.md) &ndash; true if they all pass, or returns the error message returned by the first failing constraint otherwise.
    - [GemHelperInterface::applyCopies](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyCopies.md) &ndash; Applies the copy configuration to the given path, and returns the path of the desired copy.
- [LightUploadGemsService](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService.md) &ndash; The LightUploadGemsService class.
    - [LightUploadGemsService::__construct](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService/__construct.md) &ndash; Builds the LightUploadGemsService instance.
    - [LightUploadGemsService::setContainer](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService/setContainer.md) &ndash; Sets the container.
    - [LightUploadGemsService::register](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService/register.md) &ndash; Registers the pluginName.
    - [LightUploadGemsService::getHelper](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService/getHelper.md) &ndash; Returns a GemHelperInterface associated with the given gemId, or throws an exception otherwise.
    - [LightUploadGemsService::checkPhpFile](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService/checkPhpFile.md) &ndash; Checks whether the given php file (usually from $_FILES) is erroneous, and throws an exception if it's the case.
    - [LightUploadGemsService::checkFilename](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService/checkFilename.md) &ndash; Checks whether the given filename is valid (i.e.


Dependencies
============
- [Bat](https://github.com/lingtalfi/Bat)
- [Light](https://github.com/lingtalfi/Light)
- [Light_AjaxFileUploadManager](https://github.com/lingtalfi/Light_AjaxFileUploadManager)
- [ThumbnailTools](https://github.com/lingtalfi/ThumbnailTools)
- [BabyYaml](https://github.com/lingtalfi/BabyYaml)
- [PhpFileValidator](https://github.com/lingtalfi/PhpFileValidator)


