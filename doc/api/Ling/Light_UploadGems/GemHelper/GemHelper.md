[Back to the Ling/Light_UploadGems api](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems.md)



The GemHelper class
================
2020-04-13 --> 2020-04-14






Introduction
============

The GemHelper class.



Class synopsis
==============


class <span class="pl-k">GemHelper</span> implements [GemHelperInterface](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface.md) {

- Properties
    - protected array [$config](#property-config) ;
    - protected string [$filename](#property-filename) ;
    - protected [Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) [$container](#property-container) ;
    - protected array [$tags](#property-tags) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/__construct.md)() : void
    - public [setConfig](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setConfig.md)(array $config) : void
    - public [setContainer](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setContainer.md)([Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) $container) : void
    - public [setFilename](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setFilename.md)(string $filename) : void
    - public [setTags](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/setTags.md)(array $tags) : void
    - public [applyNameTransform](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyNameTransform.md)() : void
    - public [applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyValidation.md)(string $path) : true | string
    - public [applyCopies](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyCopies.md)(string $path) : string
    - public [apply](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/apply.md)(string $path) : string
    - public [getConfig](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/getConfig.md)() : array
    - private [check](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/check.md)() : void
    - private [executeValidationRule](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/executeValidationRule.md)(string $validationRuleName, $parameter, string $filename, string $path, ?string &$errorMessage = null) : bool
    - private [getTransformedName](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/getTransformedName.md)(string $name, string $nameTransformer) : string
    - private [extractFunctionInfo](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/extractFunctionInfo.md)(string $transformer) : array
    - private [transformImage](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/transformImage.md)(string $srcPath, string $dstPath, string $imageTransformer) : bool
    - private [error](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/error.md)(string $msg) : void

}




Properties
=============

- <span id="property-config"><b>config</b></span>

    This property holds the config for this instance.
    
    

- <span id="property-filename"><b>filename</b></span>

    This property holds the filename for this instance.
    
    

- <span id="property-container"><b>container</b></span>

    This property holds the container for this instance.
    
    

- <span id="property-tags"><b>tags</b></span>

    An array of tagName => tagValue.
    
    



Methods
==============

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
- [GemHelper::check](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/check.md) &ndash; Throws an exception if the object is not properly configured.
- [GemHelper::executeValidationRule](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/executeValidationRule.md) &ndash; and return a boolean result.
- [GemHelper::getTransformedName](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/getTransformedName.md) &ndash; Transforms the name according to the given nameTransformer, and returns the transformed name.
- [GemHelper::extractFunctionInfo](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/extractFunctionInfo.md) &ndash; 
- [GemHelper::transformImage](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/transformImage.md) &ndash; Transforms the srcPath image according to the given imageTransformer, and stores it in dstPath.
- [GemHelper::error](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/error.md) &ndash; Throws an error.





Location
=============
Ling\Light_UploadGems\GemHelper\GemHelper<br>
See the source code of [Ling\Light_UploadGems\GemHelper\GemHelper](https://github.com/lingtalfi/Light_UploadGems/blob/master/GemHelper/GemHelper.php)



SeeAlso
==============
Previous class: [LightUploadGemsException](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Exception/LightUploadGemsException.md)<br>Next class: [GemHelperInterface](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface.md)<br>
