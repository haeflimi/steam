<?php
namespace Concrete\Package\SteamAuthentication;

use Package,
    Core,
    Config,
    Events;

class Controller extends Package
{
    protected $pkgHandle = 'steam';
    protected $appVersionRequired = '5.7.4';
    protected $pkgVersion = '1.0';

    public function getPackageName()
    {
        return t('Steam');
    }

    public function getPackageDescription()
    {
        return t('Adds an Authenticator for Valve\'s Steam gaming platform.');
    }

    public function on_start()
    {

    }

    public function install()
    {
        $pkg = parent::install();
        $type = \Concrete\Core\Authentication\AuthenticationType::add('steam', 'Steam', 5, $pkg);
        if(empty(\Config::get('auth.steam.apikey'))){
            $type->disable();
        }
    }

    public function upgrade()
    {
        parent::upgrade();
    }

    public function uninstall(){
        $pkg = parent::uninstall();
        $type = \Concrete\Core\Authentication\AuthenticationType::getByHandle('steam');
        $type->delete();
    }
}