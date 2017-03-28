<?php

class User extends DB
{
    private $name;
    private $email;
    private $password;

    public function __construct( $name, $email, $password, $register = false )
    {
        parent::__construct();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->fields = ['name', 'email', 'password'];
        $hasLogged = $this->login($email, $password);
        if (!$register) {
            if ( !$hasLogged )
                new UserException( 'Email or password are not correct', '/loginForm.php' );
            else {
                session_start();
                $_SESSION['logged'] = true;
                header( 'Location: stories.php' );
            }
        } elseif ($register) {
            $isUserYet = $this->isUser();
            if ( !$isUserYet ) {
                $registered = $this->register();
                if ( !$registered )
                    new UserException( 'The register couldn\'t be done', '/registerForm.php' );
                elseif ( $registered ) {
                    session_start();
                    $_SESSION[ 'logged' ] = true;
                    header( 'Location: stories.php' );
                }
            } elseif ($isUserYet){
                new UserException( 'This user is already registered', '/registerForm.php' );
            }
        }
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->email . ' ' . $this->password;
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

    private function login( $email, $password )
    {
        $this->setTable('users');
        $emailValidation = $this->where('email', $email);
        $passwordValidation = $this->where('password', $password);
        echo '<pre>count($emailValidation)  --> ' . print_r( count($emailValidation), true ) . '</pre>';
        echo '<pre>count($passwordValidation) --> ' . print_r( count($passwordValidation), true ) . '</pre>';
        if  (count($emailValidation) && count($passwordValidation))
            return 1;
        else
            return 0;
    }

    private function isUser( )
    {
        $this->setTable('users');
        $emailValidation = $this->where('email', $this->email);
        echo '<pre>count($emailValidation)' . print_r( count($emailValidation), true ) . '</pre>';
        return count($emailValidation);
    }

    private function register(  )
    {
        $values['name'] = $this->name;
        $values['email'] = $this->email;
        $values['password'] = $this->password;
        return $this->insert($values);
    }

}