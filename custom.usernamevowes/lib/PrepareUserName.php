<?php
namespace Custom\UserNameVowes;

use Bitrix\Main\SystemException;

class PrepareUserName
{
    protected $regularSearch = "/[аоуыэеёиюяaeiouy]/iu"; //Гласные буквы русского (аоуыэеёиюя) и английского алфавита (aeiouy)
    protected $UserId = 0;
    protected $UserName = '';

    public function getUserNameVowels($id)
    {   
        $this->CheckRequest($id);        
        $this->UserName = Orm\User::getUserNameById($this->UserId);

        $this->CheckUserName(); 
        $this->GetVowels();

        return $this->UserName;
    }
    protected function CheckRequest($id){

        if(!is_int($id)){
            throw new SystemException("invalid data format!");
        }
        $this->UserId = (int)$id; 
    }
    protected function CheckUserName(){
        if($this->UserName === false){ 
            throw new SystemException("User Not Found");
        }
        if($this->UserName === '' ){ 
            throw new SystemException("UserName is not filled");
        }
    }
    protected function GetVowels(){
        preg_match_all($this->regularSearch, $this->UserName, $matches);

        $this->UserName = mb_strtolower(implode('', array_shift($matches)));    
    }
}