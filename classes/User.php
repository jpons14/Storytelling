<?php

class User extends DB
{
    private $name;
    private $email;
    private $password;

    private $userId;

    public function __construct( $email, $name = '', $password = '', $register = false )
    {
        parent::__construct();
        $this->email = $email;
        $justEmail = false;
        try {
            $this->fields = [ 'name', 'email', 'password' ];
            if ( $name == '' && $password == '' ) {
                $justEmail = true;
            } else {
                $this->name = $name;
                $this->password = $password;
                if ( $register ) {
                    $this->_doRegister();
                }
                $this->_doLogin();
                session_start();
            }

        } catch ( DBException $e ) {
            $e->showException();
        }
        $_SESSION[ 'logged' ] = 'true';
        $_SESSION[ 'userId' ] = $this->userId;
        $_SESSION[ 'userEmail' ] = $this->email;

        if ( !$justEmail )
            header( 'Location: /stories.php' );
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->email . ' ' . $this->password;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function _doLogin()
    {
        $email = $this->email;
        $password = $this->password;
        $this->setTable( 'users' );
        $emailValidation = $this->where( 'email', $email );
        if ( count( $emailValidation ) === 1 ) {
            if ( password_verify( $password, $emailValidation[ 0 ][ 3 ] ) ) {
                $this->userId = $emailValidation[ 0 ][ 0 ];
                return true;
            } else //wrong password
                throw new DBException( 'Wrong password' );
        } elseif ( count( $emailValidation ) === 0 ) //wrong username
            throw new DBException( 'Wrong username' );
        else //Database exception
            throw new DBException( 'More than one item with the same ID in the DB' );
    }

    public function getUserDataById($id){
        $this->setTable('users');
        return $this->find($id);
    }

    public function getUserDataByEmail( $email = '' )
    {
        $this->setTable('users');
        if ($email == '')
            return $this->where('email', $this->email);
        else
            return $this->where('email', $email);
    }

    private function isUser()
    {
        $this->setTable( 'users' );
        $emailValidation = $this->where( 'email', $this->email );
        if ( count( $emailValidation ) === 1 )
            return true;
        else
            return false;
    }

    private function _doRegister()
    {
        if ( $this->isUser() )
            throw new DBException( 'This user already exists' );
        else {
            $values[ 'name' ] = $this->name;
            $values[ 'email' ] = $this->email;
            $values[ 'password' ] = $this->password;
            return $this->insert( $values );
        }
    }

    public static function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        unset( $_COOKIE[ 'PHPSESSID' ] );
        echo '<pre>$_COOKIE' . print_r( $_COOKIE, true ) . '</pre>';
        echo 'cookie deleted';
        header( 'Location: /index.php' );
    }

    public
    function unregister()
    {
        $this->setTable( 'users' );
        echo '<pre>$this->userId' . print_r( $this->userId, true ) . '</pre>';
        $this->destroy( (int)$this->userId );
        header( 'Location: /index.php' );
    }

}