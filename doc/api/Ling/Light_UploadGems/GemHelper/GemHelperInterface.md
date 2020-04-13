[Back to the Ling/Light_UploadGems api](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems.md)



The GemHelperInterface class
================
2020-04-13 --> 2020-04-13






Introduction
============

The GemHelperInterface interface.



Class synopsis
==============


abstract class <span class="pl-k">GemHelperInterface</span>  {

- Methods
    - abstract public [setFilename](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/setFilename.md)(string $filename) : void
    - abstract public [applyNameTransform](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyNameTransform.md)() : void
    - abstract public [applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyValidation.md)(string $path) : true | string
    - abstract public [applyCopies](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyCopies.md)(string $path) : string

}






Methods
==============

- [GemHelperInterface::setFilename](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/setFilename.md) &ndash; Sets the filename.
- [GemHelperInterface::applyNameTransform](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyNameTransform.md) &ndash; the transformed file name.
- [GemHelperInterface::applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyValidation.md) &ndash; true if they all pass, or returns the error message returned by the first failing constraint otherwise.
- [GemHelperInterface::applyCopies](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelperInterface/applyCopies.md) &ndash; Applies the copy configuration to the given path, and returns the path of the desired copy.





Location
=============
Ling\Light_UploadGems\GemHelper\GemHelperInterface<br>
See the source code of [Ling\Light_UploadGems\GemHelper\GemHelperInterface](https://github.com/lingtalfi/Light_UploadGems/blob/master/GemHelper/GemHelperInterface.php)



SeeAlso
==============
Previous class: [GemHelper](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper.md)<br>Next class: [LightUploadGemsService](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/Service/LightUploadGemsService.md)<br>
