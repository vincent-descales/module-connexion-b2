<?php 

class UserRegister {
    private ?int $id;
    private ?string $login;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $password;
    private ?string $passwordre;

    public function getId(): ?string {
        return $this->login;
    }
        
    public function setId(string $id){
        $this->id = $id;
    }     


    public function getLogin(): ?string {
        return $this->login;
    }
        
    public function setLogin(string $login){
        $this->login = $login;
    }       
    

    public function getFirstname(): ?string {
        return $this->firstname;
    }
        
    public function setFirstname(string $firstname){
        $this->firstname = $firstname;
    }    
    
    
    public function getLastname(): ?string {
        return $this->lastname;
    }
        
    public function setLastname(string $lastname){
        $this->lastname = $lastname;
    }     


    public function getPassword(): ?string {
        return $this->password;
    }
        
    public function setPassword(string $password){
        $this->password = $password;
    }     

    public function getPasswordre(): ?string {
        return $this->passwordre;
    }
        
    public function setPasswordre(string $passwordre){
        $this->passwordre = $passwordre;
    }     
}