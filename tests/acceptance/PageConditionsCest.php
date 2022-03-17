<?php 

use yii\helpers\Url;

class PageConditionsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function ensureThatConditionsPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to('/about/conditions'));
        $I->canSeeElement('#kinozal-conditions');
    }
}
