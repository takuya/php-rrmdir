<?php

if( ! function_exists('rrmdir') ) {
  function rrmdir ( $dir ):bool {
    if ( is_dir( $dir ) ) {
      $entries = scandir( $dir );
      foreach ( $entries as $entry ) {
        if ( $entry != "." && $entry != ".." ) {
          if ( is_dir( $dir.DIRECTORY_SEPARATOR.$entry )
               && !is_link( $dir.DIRECTORY_SEPARATOR.$entry ))
            rrmdir( $dir.DIRECTORY_SEPARATOR.$entry );
          else
            unlink( $dir.DIRECTORY_SEPARATOR.$entry );
        }
      }
      return rmdir( $dir );
    }else{
      return false;
    }
  }
}
