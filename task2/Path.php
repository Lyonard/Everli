<?php


class Path {
    private $currentPath;

    public function __construct( $path = PathUtils::MY_ROOT ) {
        if ( PathUtils::isPathValid( $path ) && PathUtils::isAbsolutePath( $path ) ) {
            $this->currentPath = $path;
        } else {
            throw new Exception(
                "Path invalid: it must be an absolute path and directories should match this regex: "
                . PathUtils::MY_DIR_VALIDATION_REGEX
            );
        }
    }

    public function cd( string $path = "." ) {

        if ( ! PathUtils::isPathValid( $path ) ) {
            throw new Exception( "Path invalid" );
        }

        if ( PathUtils::isAbsolutePath( $path ) ) {
            //if the path is absolute and valid, that's what we need.
            return $this->setCurrentPath( $path );
        }

        //relative Path

        // Remove the root slash and any trailing slash.
        // We will add back that after all the operations
        $currPath = trim( $this->getCurrentPath(), PathUtils::MY_ROOT );

        $currPathArray = explode( PathUtils::MY_DIR_SEPARATOR, $currPath );
        $cdPathArray   = explode( PathUtils::MY_DIR_SEPARATOR, $path );

        foreach ( $cdPathArray as $instruction ) {
            switch ( $instruction ) {
                case ".":
                    //current directory --> no-op
                    break;
                case "..":
                    //previous directory
                    array_pop( $currPathArray );
                    break;
                default:
                    //new directory
                    array_push( $currPathArray, $instruction );
            }
        }

        return $this->setCurrentPath(
            PathUtils::MY_ROOT . implode( PathUtils::MY_DIR_SEPARATOR, $currPathArray )
        );
    }


    /**
     * @return string
     */
    public function getCurrentPath() {
        return $this->currentPath;
    }

    /**
     * @param string $currentPath
     */
    private function setCurrentPath( string $currentPath ) {
        $this->currentPath = $currentPath;

        return $this;
    }
}