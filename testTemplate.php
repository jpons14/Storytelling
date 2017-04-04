<?php
$contents = file_get_contents( 'stories/story1.json' );
$contents = json_decode( $contents, true );
echo '<pre>$contents' . print_r( $contents, true ) . '</pre>';

$array = [ 'story' => []

];