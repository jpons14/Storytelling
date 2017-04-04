<?php

class Story extends Files
{

    public $contributions;

    public function __construct( $filename, $content = '', $rootPath = 'stories/' )
    {
        parent::__construct( $filename, $rootPath );
        if ( $content != '' ) {
            $this->contents = [ 'story' => [ "1" => [ 'userId' => $content[ 'userId' ], 'text' => $content[ 'text' ] ] ] ];
            $this->save();

            // Then we have to save it in the DB
            $storyDB = new StoriesDB();
            $storyDB->newStory($content['name'], $content['subject']);
        }
    }

    public function __toString()
    {
        return '<pre>$this->contents' . print_r( $this->contents, true ) . '</pre>';
    }

    public function add( $array )
    {

        $keys = array_keys( $array );
        if ( count( $keys ) == 2 && ( $keys[ 0 ] == 'userId' && $keys[ 1 ] == 'text' ) ) {
            $this->contents[ 'story' ][] = $array;
            $this->save();
            return true;
        } else {
            throw new FileException( 'The array has to have userId and text' );
        }
    }

    public function read()
    {
//        $contents = file_get_contents( $this->getRoot() );
        $contents = fread( $this->file, filesize( $this->getRoot() ) );
        // if I don't put true, returns a standard object
        // Have to have, the keys, userId,  and the text, if not should't work
        $this->contents = json_decode( $contents, true );
        return $this->contents;
    }

    protected function save()
    {
        $json = json_encode( $this->contents );


        // it should be like this, but I don't know why, is not working
//        ftruncate($this->file, 0);
//        fwrite($this->file, $json);

        return file_put_contents( $this->getRoot(), $json );
    }


    public function getContributions()
    {
        foreach ( $this->contents[ 'story' ] as $content ) {
            $this->contributions[] = $content;
        }
        return $this->contributions;
    }

    /** Has to check if the file exists (in another function)
     * If that function returns false, an array will be filled with
     * the correct data, and then create a file*/
    protected function newFile()
    {

    }
}