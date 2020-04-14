<?php


namespace Ling\Light_UploadGems\GemHelper;


use Ling\Bat\CaseTool;
use Ling\Bat\ConvertTool;
use Ling\Bat\FileSystemTool;
use Ling\Bat\FileTool;
use Ling\Bat\HashTool;
use Ling\Bat\MimeTypeTool;
use Ling\Bat\SmartCodeTool;
use Ling\Bat\TagTool;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_AjaxFileUploadManager\Exception\LightAjaxFileUploadManagerException;
use Ling\Light_UploadGems\Exception\LightUploadGemsException;
use Ling\ThumbnailTools\ThumbnailTool;


/**
 * The GemHelper class.
 */
class GemHelper implements GemHelperInterface
{

    /**
     * This property holds the config for this instance.
     * @var array
     */
    protected $config;

    /**
     * This property holds the filename for this instance.
     * @var string
     */
    protected $filename;


    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;


    /**
     * An array of tagName => tagValue.
     *
     * @var array
     */
    protected $tags;


    /**
     * Builds the GemHelper instance.
     */
    public function __construct()
    {
        $this->filename = null;
        $this->container = null;
        $this->config = [];
        $this->tags = [];
    }


    /**
     * Sets the config for this gemHelper.
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Sets the container.
     *
     * @param LightServiceContainerInterface $container
     */
    public function setContainer(LightServiceContainerInterface $container)
    {
        $this->container = $container;
    }







    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * @implementation
     */
    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }


    /**
     * @implementation
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }


    /**
     * @implementation
     */
    public function applyNameTransform(): string
    {
        $this->check();
        $name = $this->filename;
        $conf = $this->config['name'] ?? [];
        foreach ($conf as $transform) {
            $name = $this->getTransformedName($name, $transform);
        }
        $this->filename = $name;
        return $name;
    }


    /**
     * @implementation
     */
    public function applyValidation(string $path)
    {
        $this->check();
        $validationRules = $this->config['validation'] ?? [];
        if ($validationRules) {

            $errorMessage = null;
            $isValid = true;
            $filename = $this->filename ?? basename($path);


            foreach ($validationRules as $name => $param) {
                if (false === $this->executeValidationRule($name, $param, $filename, $path, $errorMessage)) {
                    $isValid = false;
                    break;
                }
            }
            if (false === $isValid) {
                return $errorMessage;
            }
        }
        return true;
    }


    /**
     * @implementation
     */
    public function applyCopies(string $path): string
    {
        $this->check();

        // reserved tag
        $this->tags['app_dir'] = $this->container->getApplicationDir();

        $desiredCopyPath = $path;
        $copies = $this->config['copies'] ?? [];
        $last = null;

        if ($copies) {

            $fileToRemove = null;

            /**
             * Filename trick part 1/3
             *
             * If the user set a filename, we create a tmp file so that the logic of this script is left intact and easier to follow,
             * we remove that tmp file in the end so that it's transparent to the caller.
             *
             * Also, if the filename contains slashes (and slashes are allowed), we need to preserve it, hence the
             * second and third parts of the trick below.
             *
             */
            if (null !== $this->filename) {
                $path = FileSystemTool::mkTmpCopy($path, $this->filename);
                $fileToRemove = $path;
            }


            $dstPaths = [$path];
            $previousPath = $path;

            $firstCopy = true;


            foreach ($copies as $copy) {


                TagTool::applyTags($this->tags, $copy);


                // filename trick part 2/3
                if (true === $firstCopy) {
                    $firstCopy = false;
                    if (null !== $this->filename && false === array_key_exists('filename', $copy)) {
                        $copy['filename'] = $this->filename;
                    }
                }


                //--------------------------------------------
                // source
                //--------------------------------------------
                $src = $previousPath;
                if (array_key_exists("input", $copy)) {
                    $index = $copy['input'];
                    if (array_key_exists($index, $dstPaths)) {

                        $src = $dstPaths[$index];

                        // filename trick part 3/3
                        if (0 === (int)$index && null !== $this->filename && false === array_key_exists('filename', $copy)) {
                            $copy["filename"] = $this->filename;
                        }


                    } else {
                        $this->error("Index \"$index\" not found in the current copies.");
                    }
                }

                //--------------------------------------------
                // destination
                //--------------------------------------------
                $dst = $previousPath;
                if (array_key_exists("path", $copy)) {
                    $dst = $copy['path'];
                    if ('/' !== $dst[0]) {
                        // relative path
                        $dir = dirname($src);
                        $dst = $dir . "/" . $dst;
                    }
                } elseif (array_key_exists('dir', $copy)) {
                    $dir = $copy['dir'];
                    if ('/' !== $dir[0]) {
                        // relative path
                        $srcDir = dirname($src);
                        $dir = $srcDir . "/" . $dir;
                    }
                    $basename = basename($dst);
                    $dst = $dir . "/" . $basename;
                }

                if (array_key_exists('basename', $copy)) {
                    $dir = dirname($dst);
                    $ext = FileSystemTool::getFileExtension($dst);
                    $dst = $dir . "/" . $copy['basename'] . "." . $ext;
                }

                if (array_key_exists('filename', $copy)) {
                    $dir = dirname($dst);
                    $dst = $dir . "/" . $copy['filename'];
                }


                //--------------------------------------------
                // last flag
                //--------------------------------------------
                if (array_key_exists('isLast', $copy) && true === $copy['isLast']) {
                    $last = $dst;
                }


                //--------------------------------------------
                // image transformation
                //--------------------------------------------
                $isAlreadyCopied = false;
                if (array_key_exists("imageTransformer", $copy)) {
                    if (true === FileTool::isImage($src)) {
                        if (true === $this->transformImage($src, $dst, $copy['imageTransformer'])) {
                            $isAlreadyCopied = true;
                        }
                    }

                }


                if (false === $isAlreadyCopied && $src !== $dst) {
                    FileSystemTool::copyFile($src, $dst);
                }
                $previousPath = $dst;
                $desiredCopyPath = $dst;
                $dstPaths[] = $dst;

            }

            if (null !== $fileToRemove) {
                FileSystemTool::remove($fileToRemove);
            }
        }


        if (null !== $last) {
            $desiredCopyPath = $last;
        }

        return $desiredCopyPath;
    }


    /**
     * @implementation
     */
    public function apply(string $path): string
    {
        $this->applyNameTransform();
        if (true !== ($result = $this->applyValidation($path))) {
            $this->error($result);
        }
        return $this->applyCopies($path);
    }


    /**
     * @implementation
     */
    public function getConfig(): array
    {
        return $this->config;
    }






    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Throws an exception if the object is not properly configured.
     * @throws \Exception
     */
    private function check()
    {
        if (null === $this->filename) {
            throw new LightUploadGemsException("Filename not defined.");
        }
    }


    /**
     * Check whether the given phpFileItem is valid according to the given rule name and parameter,
     * and return a boolean result.
     * If the file item is not valid, the error message is set to explain the cause of the validation problem.
     *
     *
     * @param string $validationRuleName
     * @param mixed $parameter
     * @param string $filename
     * @param string $path
     * @param string|null $errorMessage
     * @return bool
     * @throws \Exception
     */
    private function executeValidationRule(string $validationRuleName, $parameter, string $filename, string $path, string &$errorMessage = null): bool
    {
        switch ($validationRuleName) {
            case "maxFileSize":
                $maxFileSize = ConvertTool::convertHumanSizeToBytes($parameter);
                $fileSize = FileTool::getFileSize($path);
                if ($fileSize > $maxFileSize) {
                    $maxFileSizeHuman = ConvertTool::convertBytes($maxFileSize, "h");
                    $fileHumanWeight = ConvertTool::convertBytes($fileSize, "h");
                    $errorMessage = "Validation error: the file \"$filename\" is too big. The maximum file size allowed is $maxFileSizeHuman (the uploaded file weighted $fileHumanWeight).";
                    return false;
                }

                break;
            case "mimeType":
                $allowedMimeTypes = $parameter;
                if (false === is_array($allowedMimeTypes)) {
                    $allowedMimeTypes = [$allowedMimeTypes];
                }
                $fileMimeType = MimeTypeTool::getMimeType($path);

                if (false === in_array($fileMimeType, $allowedMimeTypes, true)) {
                    $sList = implode(", ", $allowedMimeTypes);
                    $errorMessage = "Validation error: the file \"$filename\" doesn't have an accepted mime type. The allowed mime types are $sList. But the file had a mime type of $fileMimeType.";
                    return false;
                }

                break;
            case "extensions":
                $allowedExtensions = $parameter;
                if (false === is_array($allowedExtensions)) {
                    $allowedExtensions = [$allowedExtensions];
                }
                $fileExt = strtolower(FileSystemTool::getFileExtension($filename));

                if (false === in_array($fileExt, $allowedExtensions, true)) {
                    $sList = implode(", ", $allowedExtensions);
                    $errorMessage = "Validation error: the file \"$filename\" doesn't have an accepted file extension. The allowed file extensions are $sList.";
                    return false;
                }

                break;
            case "maxFileNameLength":
                $maxFileNameLength = (int)$parameter;
                $fileLength = strlen($filename);
                if ($fileLength > $maxFileNameLength) {
                    $errorMessage = "Validation error: the filename \"$filename\" contains too many characters. The maximum number of characters allowed is $maxFileNameLength (The uploaded filename contains $fileLength characters).";
                    return false;
                }
                break;
            case "allowSlashInFilename":
                if (false === $parameter) {
                    if (false !== strpos($filename, "/")) {
                        $errorMessage = "Validation error: the filename \"$filename\" contains the forbidden slash character.";
                        return false;
                    }
                }
                break;
            default:
                throw new LightAjaxFileUploadManagerException("Unknown validation rule: $validationRuleName (with file name=\"$filename\").");
                break;
        }
        return true;
    }


    /**
     * Transforms the name according to the given nameTransformer, and returns the transformed name.
     *
     * @param string $name
     * @param string $nameTransformer
     * @return string
     * @throws \Exception
     */
    private function getTransformedName(string $name, string $nameTransformer): string
    {


        $extension = FileSystemTool::getFileExtension($name);
        $fileName = FileSystemTool::getFileName($name);
        list($transformerId, $transformerParams) = $this->extractFunctionInfo($nameTransformer);

        switch ($transformerId) {
            case "randomize":
                if (count($transformerParams) > 0) {
                    $length = $transformerParams[0];
                    if ($length > 0) {
                        $keepExtension = true;
                        if (array_key_exists(1, $transformerParams)) {
                            $keepExtension = $transformerParams[1];
                        }
                        $name = HashTool::getRandomHash64($length);
                        if (true === $keepExtension) {
                            if ($extension) {
                                $name .= "." . $extension;
                            }
                        }
                    } else {
                        throw new LightUploadGemsException("Bad configuration error: the length parameter of the randomize nameTransformer function must be greater than 0 (file name=$name).");
                    }
                } else {
                    throw new LightUploadGemsException("Bad configuration error: the length parameter of the randomize nameTransformer function is mandatory (file name=$name).");
                }

                break;
            case "changeBasename":
                if (count($transformerParams) > 0) {
                    $newName = $transformerParams[0];
                    $name = $newName;
                    if ($extension) {
                        $name .= "." . $extension;
                    }
                } else {
                    throw new LightUploadGemsException("Bad configuration error: the newName parameter of the changeFileName nameTransformer function is mandatory (file name=$name).");
                }
                break;
            case "changeFilename":
                if (count($transformerParams) > 0) {
                    $newName = $transformerParams[0];
                    $name = $newName;
                } else {
                    throw new LightUploadGemsException("Bad configuration error: the newName parameter of the set nameTransformer function is mandatory (file name=$name).");
                }
                break;
            case "snake":
                $name = CaseTool::toSnake($fileName);
                if ($extension) {
                    $name .= "." . $extension;
                }
                break;
            default:
                throw new LightUploadGemsException("Bad configuration error: the nameTransformer function $transformerId is not recognized yet (file name=$name).");
                break;
        }

        return $name;
    }

    /**
     * Parses the given transformer string, and returns an info array with the following structure:
     *
     * - 0: transformer id (the function name)
     * - 1: array of parameters
     *
     *
     * @param string $transformer
     * @return array
     * @throws \Exception
     *
     */
    private function extractFunctionInfo(string $transformer): array
    {
        $p = explode('(', $transformer, 2);
        $transformerId = trim($p[0]);
        $transformerParams = [];
        if (2 === count($p)) {
            $transformerStringParams = trim($p[1], ') ');
            $transformerParams = SmartCodeTool::parse('[' . $transformerStringParams . ']');
        }
        return [
            $transformerId,
            $transformerParams,
        ];
    }


    /**
     * Transforms the srcPath image according to the given imageTransformer, and stores it in dstPath.
     * Returns whether the creation of the copy was successful.
     *
     * In case of errors throws exceptions.
     *
     *
     * @param string $srcPath
     * The path to a supposedly valid image.
     *
     * @param string $dstPath
     * @param string $imageTransformer
     *
     * @return bool
     * @throws \Exception
     */
    private function transformImage(string $srcPath, string $dstPath, string $imageTransformer): bool
    {
        list($transformerId, $transformerParams) = $this->extractFunctionInfo($imageTransformer);
        switch ($transformerId) {
            case "resize":
                $width = $transformerParams[0] ?? null;
                $height = $transformerParams[0] ?? null;

                $extension = FileSystemTool::getFileExtension($dstPath);
                $options = [
                    "extension" => $extension,
                ];
                if (true === ThumbnailTool::biggest($srcPath, $dstPath, $width, $height, $options)) {
                    return true;
                } else {
                    $filename = basename($srcPath);
                    throw new LightUploadGemsException("ThumbnailTool error: couldn't resize the image (filename=\"$filename\").");
                }
                break;
            default:
                $filename = basename($srcPath);
                throw new LightUploadGemsException("Bad configuration error: the imageTransformer function $transformerId is not recognized yet (file name=\"$filename\").");
                break;
        }
        return false;
    }


    /**
     * Throws an error.
     *
     * @param string $msg
     * @throws LightUploadGemsException
     */
    private function error(string $msg)
    {
        throw new LightUploadGemsException($msg);
    }


}