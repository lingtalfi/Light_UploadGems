<?php


namespace Ling\Light_UploadGems\GemHelper;


/**
 * The GemHelperInterface interface.
 */
interface GemHelperInterface
{

    /**
     * Sets the filename.
     *
     * @param string $filename
     * @return void
     */
    public function setFilename(string $filename);


    /**
     * Sets an array of tags that will be used in the applyCopies method.
     *
     * @param array $tags
     */
    public function setTags(array $tags);


    /**
     * A shortcut method that applies the following methods in that order:
     * - applyNameTransform
     * - applyValidation (throws an exception if a validation error occurs)
     * - applyCopies
     *
     * and returns the output of the applyCopies method.
     *
     *
     * @param string $path
     * @return string
     * @throws \Exception
     */
    public function apply(string $path): string;

    /**
     * Returns the config array attached to this instance.
     * @return array
     */
    public function getConfig(): array;

    /**
     * Applies the name transformations defined in the internal config, and returns
     * the transformed file name.
     *
     * If an error occurs, an exception is thrown.
     *
     * @throws \Exception
     */
    public function applyNameTransform(): string;


    /**
     * Applies the validation constraints defined in the internal config, and returns
     * true if they all pass, or returns the error message returned by the first failing constraint otherwise.
     *
     *
     * @param string $path
     * The absolute path to the file to validate.
     *
     * @return true|string
     */
    public function applyValidation(string $path);


    /**
     * Applies the copy configuration to the given path, and returns the path of the desired copy.
     * See more information in the @page(UploadGems conception notes).
     *
     *
     * @param string $path
     * The absolute path to the file to copy.
     *
     * @return string
     * @throws \Exception
     */
    public function applyCopies(string $path): string;

}