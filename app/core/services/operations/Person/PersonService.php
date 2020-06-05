<?php

namespace app\core\services\operations\Person;

use app\models\ActiveRecord\Person;
use app\core\repositories\PersonRepository;
use app\models\Forms\Manage\PersonForm;

/**
 * Description of PersonService
 *
 * @author kotov
 */
class PersonService
{
    /**    
     * @param PersonRepository $perspns
     */
    protected $persons;
           
    public function __construct(PersonRepository $persons)
    {
        $this->persons = $persons; 
    } 

    /**
     * 
     * @param PersonForm $form
     * @return Person
     */    
    public function create($form)
    {
        $person = Person::create(
                $form->name, 
                $form->year);
        if (!$person->save()) {
            throw new \RuntimeException('Ошибка сохранения.');        
        }
        return $person;   
    }

    public function edit($id, PersonForm $form)
    {
        /* @var $person Person */
        $person = $this->persons->findById($id);
        $person->edit($form->name, $form->year);  
        $this->persons->save($person);
    }
    
    public function remove ($id) 
    {
        /* @var $person Person */
         $person = $this->persons->findById($id);
         $this->persons->remove($person);
    }
}
