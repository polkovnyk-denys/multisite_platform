<?php

/**
 * Get the path to the partials directory
 */
function partials_path(string $part): string
{
    return "template-parts/partials/{$part}";
}

/**
 * Get the path to the sections directory
 */
function sections_path(string $part): string
{
    return "template-parts/sections/{$part}";
}

/**
 * Get the path to the partials directory
 */
function get_partials_path($part): string
{
    return "template-parts/partials/{$part}";
}

/**
 * Get the path to the micro-partials directory
 */
function micro_partials_path(string $part): string
{
    return "template-parts/micro-partials/{$part}";
}

/**
 * Get the path to the schema directory
 */
function schema_path(string $part): string
{
    return "template-parts/schema/{$part}";
}

/**
 * Get the path to the content directory
 */
function content_path(string $part): string
{
    return "template-parts/content/{$part}";
}
