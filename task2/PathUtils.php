<?php


class PathUtils {
    const MY_ROOT = "/";
    const MY_DIR_SEPARATOR = "/";
    const MY_DIR_VALIDATION_REGEX = "/([a-zA-Z]+|\.{1,2})/";


    public static function isPathValid( string $path ): bool {
        $path = trim( $path,self::MY_ROOT );

        $dirs = explode( self::MY_DIR_SEPARATOR, $path );

        return array_reduce(
            $dirs,
            function ( $lastWasOk, $value ) {
                return $lastWasOk && self::isDirValid( $value );
            },
            true
        );
    }

    public static function isDirValid( $dir ): bool {
        return preg_match( self::MY_DIR_VALIDATION_REGEX, $dir );
    }

    public static function isAbsolutePath( string $path ) {
        return strpos( $path, "/" ) === 0;
    }
}