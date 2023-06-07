<?php

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
function redirect($path)
{
    header("Location: /{$path}");
}
