<?php

class Files
{
    private $rootPath;

    private $filename;

    protected $contents = array();

    private $root;

    /**
     * @var resource
     */
    protected $file;

    /**
     * Files constructor.
     * @param $filename
     * @param string $rootPath have to end with a slash
     */
    public function __construct( $filename, $rootPath = 'stories/' )
    {
        $this->rootPath = $rootPath;
        $this->filename = $filename . '.json';
        $this->setRoot();
        $this->file = @fopen($this->root, 'rw');
        if (!$this->file) {
            file_put_contents( $this->root, '' );
            $this->file = fopen($this->root, 'rw');
        }
//        flock($this->file, LOCK_SH);
//        $this->read();
    }

    public function __destruct(  )
    {
        fclose($this->file);
    }

    public function setRootPath( $rootPath )
    {
        $this->rootPath = $rootPath;
    }

    public function setFilename( $filename )
    {
        $this->filename = $filename;
    }

    private function setRoot(){
        $this->root = $this->rootPath . $this->filename;
    }

    protected function getRoot(  )
    {
        return $this->root;
    }

    public function getRootPath() { return $this->rootPath; }

    public function getFileName() { return $this->filename; }

    public function __toString()
    {
        return '<pre>$this->contents' . print_r( $this->contents, true ) . '</pre>';
    }

    public function read(){}


    public function add( $array ){}

    protected function save(){}

    protected function newFile(){}

    /**
     * @param $rootPath string
     * @param $filename string
     */
    public static function checkIfExists($rootPath = 'stories/', $filename){
        foreach ( glob("$rootPath*.json") as $fileName ) {
            echo '<pre>$fileName  ' . print_r( $fileName, true ) . '</pre>';
        }
    }
}