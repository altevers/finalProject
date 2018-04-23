<?php

class User {
    protected $userID;
    protected $nkuID;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $gender;
    protected $email;
    protected $gpa;
    protected $classLevel;
    protected $highSchool;
    protected $cellPhone;
    protected $database;
    
    protected $membership;
    protected $responsibility;
    protected $subs = array();
    
    function __construct($userID, $DB) {
        $this->userID = $userID;
        $this->database = $DB;
        
        $user = NULL;
        
        $sql = file_get_contents('sql/getUserInfo.sql');
        $params = array (
            'userID' => $userID
        );
        $statement = $DB->prepare($sql);
        $statement->execute($params);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if(!empty($users)) {
            $user = $users[0];
            
            $this->userID = $user['userID'];
            $this->nkuID = $user['nkuID'];
            $this->password = $user['password'];
            $this->firstName = $user['firstName'];
            $this->lastName = $user['lastName'];
            $this->gender = $user['gender'];
            $this->email = $user['email'];
            
            $this->gpa = $user['gpa'];
            $this->classLevel = $user['classLevel'];
            $this->highSchool = $user['highSchool'];
            $this->cellPhone = $user['cellPhone'];
            
            $sql = file_get_contents('sql/getMembership.sql');
            $params = array (
                'userID' => $userID
            );
            $statement = $DB->prepare($sql);
            $statement->execute($params);
            $memberships = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(!empty($memberships)) {
                $membership = $memberships[0];
                
                $this->membership = $membership['membership'];
            }
            else {
                $this->membership = 0;
            }
            
            $sql = file_get_contents('sql/getResponsibility.sql');
            $params = array (
                'responsibilityID' => $this->membership
            );
            $statement = $DB->prepare($sql);
            $statement->execute($params);
            $responsibilities = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(!empty($responsibilities)) {
                $responsibility = $responsibilities[0];
                
                $this->responsibility = $responsibility['name'];
            }
            else {
                $this->responsibility = 0;
            }
            
            $sql = file_get_contents('sql/getUserChapter.sql');
            $params = array (
                'userID' => $userID
            );
            $statement = $DB->prepare($sql);
            $statement->execute($params);
            $chapters = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(!empty($chapters)) {
                $chapter = $chapters[0];
                
                $this->chapterID = $chapter['chapterID'];
                $this->chapter = $chapter['chapterName'];
            }
            else {
                $this->chapterID = 0;
            }
            
            $sql = file_get_contents('sql/getSubscriptions.sql');
            $params = array (
                'userID' => $userID
            );
            $statement = $DB->prepare($sql);
            $statement->execute($params);
            $subscriptions = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(!empty($subscriptions)) {
                foreach($subscriptions as $subscription) {
                    $this->subs[] = $subscription['chapterID'];
                }
                
            }
            
        }
        
        else {
            $this->userID = 0;
            $this->nkuID = NULL;
            $this->password = NULL;
            $this->firstName = NULL;
            $this->lastName = NULL;
            $this->gender = NULL;
            $this->email = NULL;
            $this->gpa = NULL;
            $this->classLevel = NULL;
            $this->highSchool = NULL;
            $this->cellPhone = NULL;
            
            $this->membership = 4;
        }
        
    }
    
// MEMBERSHIP, TESTING //
    
    function setMembership($membership){
        $this->membership = $membership;
    }
    
    function getMembership(){
        return $this->membership;
    }
    
    function getResponsibility(){
        return $this->responsibility;
    }
    
    function getSubscriptions(){
        return $this->subs;
    }
    
    function isGuest(){
        if($this->getUserID() == 0){
            $this->gender = '_';
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
// SETTERS //
    
    function setPassword($password){
        $this->password = $password;
    }
    
    function setEmail($email){
        $this->email = $email;
    }
    
    function setGPA($gpa){
        $this->gpa = $gpa;
    }
    
    function setClassLevel($classLevel){
        $this->classLevel = $classLevel;
    }
    
    function setHighSchool($highSchool){
        $this->highSchool = $highSchool;
    }
    
    function setCellPhone($cellPhone){
        $this->cellPhone = $cellPhone;
    }
    
// GETTERS //
    // REQUIRED AKA ALWAYS PRESENT //
    
    function getUserID() {
		return $this->userID;
    }
    
    function getNKUID() {
		return $this->nkuID;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function getFirstName() {
		return $this->firstName;
    }
    
    function getLastName() {
		return $this->lastName;
    }
    
    function getGender() {
        return $this->gender;
    }
    
    function getEmail() {
		return $this->email;
    }
    
    // NOT REQUIRED //
    
    function getGPA() {
        if(!empty($this->gpa)) {
            return $this->gpa;    
        }
        return;
    }
    
    function getClassLevel() {
        if(!empty($this->classLevel)) {
            return $this->classLevel;    
        }
        return;
    }
    
    function getHighSchool() {
        if(!empty($this->highSchool)) {
            return $this->highSchool;    
        }
        return;
    }
    
    function getCellPhone() {
        if(!empty($this->cellPhone)) {
            return $this->cellPhone;    
        }
		return;
    }
    
    function getChapterID() {
        if(!empty($this->chapterID)) {
            return $this->chapterID;    
        }
        return;
    }
    
    function getChapter() {
        if(!empty($this->chapter)) {
            return $this->chapter;    
        }
        return;
    }
    
}

?>