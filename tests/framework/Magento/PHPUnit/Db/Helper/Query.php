<?php

/**
 * Static class, which helps to work with SQL query.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Helper_Query
{
    /**
     * Obfuscates SQL query (removes all unneeded spaces).
     *
     * @param string|Zend_Db_Select $sql
     * @return string
     */
    public static function compress($sql)
    {
        $sql = (string)$sql;
        $compressedSql = '';
        $sqlLength = function_exists('mb_strlen') ? mb_strlen($sql) : iconv_strlen($sql);
        $insideIdentifier = false;
        $insideString = false;
        $wasAlphanum = false;
        $position = 0;
        while ($position < $sqlLength) {

            $currentChar = $sql{$position};
            if (($currentChar == '"' || $currentChar == '`') && !$insideString) {
                $wasAlphanum = false;
                if ($position + 1 != $sqlLength &&
                    ($sql{$position + 1} == '"' || $sql{$position + 1} == '`') &&
                    $insideIdentifier
                ) {
                    $compressedSql .= $currentChar.$sql{$position+1};
                    $position += 2;
                    continue;
                }
                $insideIdentifier = !$insideIdentifier;
            } elseif ($currentChar == '\\' && $insideString) {
                $wasAlphanum = false;
                if ($position + 1 != $sqlLength && ($sql{$position + 1} == '\\' || $sql{$position + 1} == '\'')) {
                    $compressedSql .= $currentChar.$sql{$position+1};
                    $position += 2;
                    continue;
                }
            } elseif ($currentChar == '\'' && !$insideIdentifier) {
                $wasAlphanum = false;
                $insideString = !$insideString;
            } elseif (!$insideString && !$insideIdentifier) {
                if (ctype_space($currentChar)) {
                    ++$position;
                    continue;
                } elseif (ctype_alnum($currentChar)) {
                    if ($wasAlphanum && ctype_space($sql{$position - 1})) {
                        $compressedSql .= ' ';
                    }
                    $wasAlphanum = true;
                } else {
                    $wasAlphanum = false;
                }
            }

            $compressedSql .= $currentChar;
            ++$position;
        }
        return $compressedSql;
    }
}
