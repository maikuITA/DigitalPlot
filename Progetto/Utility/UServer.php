<?php
/**
 * Class to access the $_SERVER superglobal array, You must use this array instead of using directly the _SERVER array
 */
class UServer
{
    /**
     * Singleton instance
     */
    private static ?UServer $instance = null;

    public static function getInstance(): ?UServer
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get the request method of the server (e.g., POST, GET, etc.)
     * @return string|null
     */
    public static function getRequestMethod(): ?string {
        return $_SERVER['REQUEST_METHOD'] ?? null;
    }

    /**
     * Get the client ip or null
     * @return string|null
     */
    public static function getClientIP() : ?string {
        if($_SERVER['REMOTE_ADDR'] === null) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null;
        } else {
            return $_SERVER['REMOTE_ADDR'];
        } 
    }

    /**
     * Get a value from the SERVER array
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key): mixed
    {
        return $_SERVER[$key] ?? null;
    }
}