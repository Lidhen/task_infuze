<?php
namespace Custom\UserNameVowes\Orm;

class User
{
    static function getUserNameById($id)
    {
        $user = self::GetUserById($id);
        if($user){
            return "${user['NAME']}${user['LAST_NAME']}${user['SECOND_NAME']}";
        }
        return false;
    }
    static function GetUserById($id)
    {
        return \Bitrix\Main\UserTable::GetList([
            'select' => ['LAST_NAME', 'NAME', 'SECOND_NAME'], 
            'filter' => ['=ID' => $id],
            'cache' => ['ttl' => 3600]
        ])->Fetch();
    }
}