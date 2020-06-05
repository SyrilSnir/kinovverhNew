<?php

namespace app\core\services\operations;

use app\models\ActiveRecord\Country;
use app\core\repositories\Geografy\CountryRepository;
use app\models\Forms\Manage\Geografy\CountryForm;

/**
 * Description of CountryService
 *
 * @author kotov
 */
class CountryService
{
    /**    
     * @param CountryRepository $countries
     */
    protected $countries;
           
    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries; 
    }
    
    /**
     * 
     * @param CountryForm $form
     * @return Country
     */
    public function create($form)
    {
        $country = Country::create(
            $form->name,
            $form->code);
        if (!$country->save()) {
            throw new \RuntimeException('Ошибка сохранения.');        
        }
        return $country;   
    }
    
    public function edit($id, CountryForm $form)
    {
        /* @var $country Country */
        $country = $this->countries->findById($id);
        $country->edit($form->name, $form->code);  
        $this->countries->save($country);
    }
    
    public function remove ($id) 
    {
        /* @var $country Country */
         $country = $this->countries->findById($id);
         $this->countries->remove($country);
    }
           
    
}
