<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $mail
 * @property int $age
 * @property string $role
 * @property string $sex
 * @property string $country
 * @property \Cake\I18n\FrozenTime $creado
 *
 * @property \App\Model\Entity\Car[] $cars
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'login' => true,
        'password' => true,
        'mail' => true,
        'age' => true,
        'role' => true,
        'sex' => true,
        'country' => true,
        'creado' => true,
        'cars' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    //Aqui usamos el accessor para encriptar el campo password
    protected function _setPassword($value){

        if(!empty($value)){

        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value); 

        }else{//recuperar el password del usuario
            $id_user = $this->_properties['id'];     
            $user = TableRegistry::get('Users')->recoverPassword($id_user);
            return $user;
        }
    }
}


