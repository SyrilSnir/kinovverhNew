<?php 

class PageAboutCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function ensureThatAboutPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(\yii\helpers\Url::to('/about/o_kinozale'));
        $I->canSeeElement('#kinozal-about');
    }
}
