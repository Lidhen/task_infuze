<?php
/* Контроллер для обработки ajax */

namespace Custom\UserNameVowes\Controller;

use Bitrix\Main\SystemException;

class User extends \Bitrix\Main\Engine\Controller
{
    public function GetUserNameVowelsAction()
    {
        $request = $this->getRequest();
        $UserId = (int)$request->getPost("user_id"); // Желательно сделать еще проверку на тип передаваемого значения
        
        try
        {
            $name = (new \Custom\UserNameVowes\PrepareUserName())->getUserNameVowels($UserId);

            return ['status' => 'success' , 'result' => $name];
        }
        catch (SystemException $exception)
        {
            return ['status' => 'error' , 'error_msg' => $exception->getMessage()];
        }
    }
}