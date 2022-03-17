<?php 

use yii\helpers\Url;

class TestLoginModalCest
{
    public function _before(AcceptanceTester $I)
    {
    }
  
    public function ensureShowLoginModalWindow(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->dontSeeElement('#pop-register');
        $I->dontSeeElement('#pop-enter');
        $I->click('#show-login-form');
        $I->wait(.5);
        $I->seeElement('#pop-enter');
        $I->dontSeeElement('#pop-register');
        $I->click('#register-form-submit');
        $I->wait(.5);
        $I->seeElement('#pop-register');
        $I->dontSeeElement('#pop-enter');
        $I->waitForElement('#pop-register .close', 30);
        $I->click('#pop-register .close');
        $I->wait(2);
        $I->dontSeeElement('#pop-enter');
        $I->dontSeeElement('#pop-register');        
    }    
}
