<?php

namespace MagicApp\XLSX;

use MagicApp\AppLanguage;
use MagicObject\Database\PicoPageData;
use MagicObject\MagicObject;

/**
 * Class DocumentWriter
 *
 * Abstract class for writing documents in different formats (e.g., XLSX, CSV).
 * It provides methods for setting and retrieving application language and for 
 * checking data fetching options. Specific document writing logic should be 
 * implemented in subclasses such as XLSXDocumentWriter and CSVDocumentWriter.
 */
class DocumentWriter
{
    /**
     * Header format
     *
     * @var array
     */
    protected $headerFormat = array();

    /**
     * Application language
     *
     * @var AppLanguage
     */
    protected $appLanguage;

    /**
     * Constructor
     *
     * @param AppLanguage $appLanguage Application language instance
     */
    public function __construct(AppLanguage $appLanguage)
    {
        $this->appLanguage = $appLanguage;
    }

    /**
     * Check if no data has been fetched
     *
     * @param PicoPageData $pageData Page data
     * @return bool True if no data has been fetched, false otherwise
     */
    protected function noFetchData(PicoPageData $pageData): bool
    {
        return $pageData->getFindOption() & MagicObject::FIND_OPTION_NO_FETCH_DATA;
    }

    /**
     * Get the application language
     *
     * @return AppLanguage The current application language
     */ 
    public function getAppLanguage(): AppLanguage
    {
        return $this->appLanguage;
    }

    /**
     * Set the application language
     *
     * @param AppLanguage $appLanguage Application language
     * @return self
     */ 
    public function setAppLanguage(AppLanguage $appLanguage): self
    {
        $this->appLanguage = $appLanguage;

        return $this;
    }

    /**
     * Create an instance of XLSXDocumentWriter
     *
     * @param AppLanguage $appLanguage Application language
     * @return XLSXDocumentWriter An instance of XLSXDocumentWriter
     */
    public static function getXLSXDocumentWriter(AppLanguage $appLanguage): XLSXDocumentWriter
    {
        return new XLSXDocumentWriter($appLanguage);
    }

    /**
     * Create an instance of CSVDocumentWriter
     *
     * @param AppLanguage $appLanguage Application language
     * @return CSVDocumentWriter An instance of CSVDocumentWriter
     */
    public static function getCSVDocumentWriter(AppLanguage $appLanguage): CSVDocumentWriter
    {
        return new CSVDocumentWriter($appLanguage);
    }
}
