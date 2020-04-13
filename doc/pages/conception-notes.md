Light_UploadGems, conception notes
=============
2020-04-10



This is a helper that replaces the [Light_AjaxFileUploadManager plugin](https://github.com/lingtalfi/Light_AjaxFileUploadManager).

It's used when the user uploads a file via a js client, and you want to process the information server side.

It helps you organize your data in **gems**.

Each **gem** is a [babyYaml](https://github.com/lingtalfi/BabyYaml) file which contain the information necessary for your server
side script to do the upload in the way you want.

Basically, you can put information that you want in a gem, and the client refers to it with an id.

Our service basically helps getting access to those gems. 
The **gems** are put in a directory chosen by your plugin, the default is **${app_dir}/config/data/${yourPluginName}/Light_UploadGems**, but
you can change it.

In addition to that, we provide useful tools that can speed up your development time, such as validation tools on the uploaded blob,
and basic actions (such as copying a file, redimensioning images, those kind of things...).



The basic synopsis
-----------
2020-04-10


When your script receives the gem id, he asks for our helper, using the **getHelper** method.

Our service then returns the helper object, which contains all the methods that you can use.

To start with, you should define the name of the uploaded file (does it come from the $_FILES array attached to the request,
or is it one that you decide by yourself?).



Once this is define, you can use the following methods (we recommend in that order):


- **applyNameTransform** to update the name via some of our methods (such as randomization).
- **applyValidation** to validate the file against the validation rules defined in the gem (see the validation section below).
- **applyCopies** to create copies of the uploaded file.

Eventually, use the **getConfig** method to access your configuration stored in the gem. 



The gem id and the gems organization
-------------
2020-04-10


The **gem id** is passed by the client, and parsed by our service which returns a helper object.

In order for this system to work, your plugin must first register to our service.
You can set the path to the **gems directory** if you want, or use our default value. 


Then the **gem id** notation must be follow this convention: 

- gemId: $pluginName.$gemName


From that **gem id**, our service will guess the path to the gem file like this:

- gemPath: $gemsDirectory/$gemName.byml


That's where your **gem** file should be (otherwise an error will be thrown).









The gem structure
-------------
2020-04-10


A **gem** contains four parts (all optional):

- name
- validation
- copies
- config


The **name**, **copies** and **validation** parts are services provided by us, while the **config** part is where you put any 
information your script needs to accomplish the upload task.


The **name** part applies to the filename defined in the helper.

Both the **copies** and the **validation** parts applies on the uploaded blob.


Name
-------
2020-04-10


With the **name** section of the gem, you can apply transformations on the **filename** set in the helper.

This is done by calling the **applyNameTransform** method.

It's important to understand that the **applyValidation** and **applyCopies** methods use the helper's **filename** if set.
Therefore you generally want to use the **applyNameTransform** method before the **applyValidation** and **applyCopies** methods.  


The **name** section contains an array of transformers, amongst the following:

- randomize($length, $keepExtension=true): returns a random name of $length character ($length being an int of your choice). 
- snake: returns the snake version of the file name. See the [toSnake](https://github.com/lingtalfi/Bat/blob/master/CaseTool.md#tosnake) method for more info.
- changeBasename($newName): changes the file basename to $newName, the file extension (string part after the last dot of the string) is kept intact.
- changeFileName($newName): changes the whole filename (including the file extension) to $newName. 
               



Validation
-------------
2020-04-10


With the **validation** section of the gem, we provide you with a quick way to validate the uploaded file.

The **validation** action is triggered manually by your script, using our helper's **applyValidation** method, which returns either true (in case of success),
or an error message otherwise (if the validation fails).


The **validation** configuration is as following (all optional):

- maxFileSize: string, the maximum size for the file. You can put human like values (2M, 500ko, 1g, ...).  
- extensions: string|array, the allowed extensions.  
- mimeTypes: string|array, the allowed mime types.  
- maxFileNameLength: int, the maximum number of characters allowed for the filename.  
- allowSlashInFileName: bool, whether slash characters are allowed in the filename.



Copies
---------
2020-04-10


Our helper provides an **applyCopies** method, which let you copy the uploaded file any number of times, with the possibility
of applying a transformation on every copy, such as image redimensioning for instance.

You define a chain (i.e. array) of copies (at least one copy), and each copy returns a path that is re-used as the input of the next copy, and so on.

The **applyCopies** method returns the path of the **desired copy** (which is the return of the last copy by default), so that your script can process the 
uploaded file further.




Each **copy** is a configuration array which contains the following (all optional):


- input: int, indicates the index of a previous copy which output to use as the input. This is 1-based indexed, so 0 refers to the original uploaded file,
    1 to the first copy, 2 the second copy, etc...
    
- isLast: bool, set this to true if you wish that this copy's return is used as the return of the **applyCopies** method.

    Note: there can be at most only one copy with this property set to true.     

- basename: string, will change the basename of that copy, leaving the file extension unchanged.
- filename: string, will change the filename of that copy, including the file extension
- path: string, sets the destination path where the file should be copied to. The path is absolute if it starts with slash (/).
    Otherwise it's relative to the directory containing this copy source.
    The use of directory traversal sequences (../) is allowed in relative paths.
    The {app_dir} tag can be used in absolute paths and refers to the light application directory.
    Note: if the path starts with the {app_dir} tag, it's considered absolute too.
    
- dir: string, sets the directory where to put the file. It uses the same rules as the **path** property.    
    
- imageTransformer: string, an **image transform string**. This will apply only if the uploaded file is an image.

    If the given file is not an image, the transform will silently be ignored and the processing will continue. 

    The possible values are:
    
    - resize($width=null, $height=null): this transformer will resize the image (up-resizing or down resizing are both permitted, but keep in mind
        that the up-resizing is associated with a loss of quality of the image).
        
        The way it works is that this transformer always keeps the original ratio of the image.
        If only one parameter is specified and the other set to null (for instance width=500 and height=null),
        then the specified parameter is the absolute width (or height) that the resulting image will have.
                            
        When both parameters are specified at the same time, they represent the maximum width and maximum height 
        that the resulting image can have.
                            
        If none of the parameters are specified, the original image will be simply copied with the same dimensions.
        You shouldn't use the transformer without specifying any parameter (it's faster to not use an image transformer at all
        in this case).
    
        Examples: 
      
        - resize(800)                            
        - resize(800, 300)                            
        - resize(null, 300)                            



Note that the **basename**, **filename**,  **path** and **dir** properties might overlap themselves if you don't use them appropriately.
Implementation wise they are executed in the following order: path else dir, then basename, then filename (i.e. filename will always prevail).




Config
----------
2020-04-10


This part contains an array which you define.

It's just a storage facility for your script to use.


 


Other methods of our service
------------
2020-04-10

In addition to the methods aforementioned, our service provides the following methods that
can help you reduce up your development time:


- checkPhpFile (array phpFile), throws an error if the given php file (from $_FILES) is erroneous
 
