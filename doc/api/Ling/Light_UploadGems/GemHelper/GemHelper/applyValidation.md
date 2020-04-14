[Back to the Ling/Light_UploadGems api](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems.md)<br>
[Back to the Ling\Light_UploadGems\GemHelper\GemHelper class](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper.md)


GemHelper::applyValidation
================



GemHelper::applyValidation — true if they all pass, or returns the error message returned by the first failing constraint otherwise.




Description
================


public [GemHelper::applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyValidation.md)(string $path) : true | string




Applies the validation constraints defined in the internal config, and returns
true if they all pass, or returns the error message returned by the first failing constraint otherwise.




Parameters
================


- path

    The absolute path to the file to validate.


Return values
================

Returns true | string.








Source Code
===========
See the source code for method [GemHelper::applyValidation](https://github.com/lingtalfi/Light_UploadGems/blob/master/GemHelper/GemHelper.php#L132-L154)


See Also
================

The [GemHelper](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper.md) class.

Previous method: [applyNameTransform](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyNameTransform.md)<br>Next method: [applyCopies](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems/GemHelper/GemHelper/applyCopies.md)<br>

