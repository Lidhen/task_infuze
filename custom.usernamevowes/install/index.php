<?php
/* Установщим модуля */
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class custom_UserNameVowes extends CModule
{
    public $MODULE_ID = 'custom.usernamevowes';

    public $MODULE_NAME;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;
    public $MODULE_PATH;

    public $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME = Loc::getMessage('CUSTOM_UNV_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('CUSTOM_UNV_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('CUSTOM_UNV_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('CUSTOM_UNV_MODULE_PARTNER_URL');
    }
    public function DoInstall()
    {
        $this->registerModule();
        $this->registerEvents();
     
        //Install compoents
        //Install files
    }
    public function DoUninstall()
    {
        $this->unregisterEvents();
        $this->unRegisterModule();

        //UnRegister Events
        //UnInstall compoents
        //UnInstall files
    }
    public function registerModule()
    {
        RegisterModule($this->MODULE_ID);
    }
    public function unRegisterModule()
    {
        UnRegisterModule($this->MODULE_ID);
    }
    public function registerEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler(
            'rest',
            'OnRestServiceBuildDescription',
            $this->MODULE_ID,
            '\Custom\UserNameVowes\Event\RestService',
            'getDescription'
        );
    }
    public function unregisterEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->unregisterEventHandler(
            'rest',
            'OnRestServiceBuildDescription',
            $this->MODULE_ID,
            '\Custom\UserNameVowes\Event\RestService',
            'getDescription'
        );
    }
}