<?php

if (!function_exists('dd')) {
    function dd()
    {
        call_user_func_array('var_dump', func_get_args());
        die;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param string $key
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if (false === $value) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if ('' === $value && '"' === $value[0] && '"' === substr($value, -1)) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('isset_or')) {
    /**
     * @param =mixed $_
     * @param =mixed $_value_
     **
     **/
    function isset_or($_, $_value_ = null)
    {
        return isset($_) ? $_ : $_value_;
    }
}
