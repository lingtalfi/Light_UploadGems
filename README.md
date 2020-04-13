Light_UploadGems
===========
2020-04-13



A php mini library to help with file upload handling.


This is a [Light plugin](https://github.com/lingtalfi/Light/blob/master/doc/pages/plugin.md).

This is part of the [universe framework](https://github.com/karayabin/universe-snapshot).


Install
==========
Using the [uni](https://github.com/lingtalfi/universe-naive-importer) command.
```bash
uni import Ling/Light_UploadGems
```

Or just download it and place it where you want otherwise.






Summary
===========
- [Light_UploadGems api](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/api/Ling/Light_UploadGems.md) (generated with [DocTools](https://github.com/lingtalfi/DocTools))
- [Services](#services)
- Pages
    - [Conception notes](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/pages/conception-notes.md)






Services
=========


Here is an example of the service configuration:

```yaml
upload_gems:
    instance: Ling\Light_UploadGems\Service\LightUploadGemsService
    methods:
        setContainer:
            container: @container()


```



History Log
=============

- 1.0.0 -- 2020-04-13

    - initial commit