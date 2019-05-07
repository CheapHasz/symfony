<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Intl;

use Symfony\Component\Intl\Exception\MissingResourceException;

/**
 * Gives access to region-related ICU data.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class Countries extends ResourceBundle
{
    /**
     * @return string[]
     */
    public static function getCountryCodes(): array
    {
        return self::readEntry(['Regions'], 'meta');
    }

    public static function exists(string $country): bool
    {
        try {
            self::readEntry(['Names', $country]);

            return true;
        } catch (MissingResourceException $e) {
            return false;
        }
    }

    /**
     * @throws MissingResourceException if the country code does not exists
     */
    public static function getName(string $country, string $displayLocale = null): string
    {
        return self::readEntry(['Names', $country], $displayLocale);
    }

    /**
     * @return string[]
     */
    public static function getNames($displayLocale = null)
    {
        return self::asort(self::readEntry(['Names'], $displayLocale), $displayLocale);
    }

    protected static function getPath(): string
    {
        return Intl::getDataDirectory().'/'.Intl::REGION_DIR;
    }
}