<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CarsUser Entity
 *
 * @property int $id
 * @property int $car_id
 * @property int $user_id
 * @property float $consumoCiudad
 * @property float $consumoAutopista
 * @property float $combinado
 * @property string $tipoConduccion
 * @property \Cake\I18n\FrozenTime $creado
 *
 * @property \App\Model\Entity\Car $car
 * @property \App\Model\Entity\User $user
 */
class CarsUser extends Entity
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
        'consumoCiudad' => true,
        'consumoAutopista' => true,
        'combinado' => true,
        'tipoConduccion' => true,
        'creado' => true,
        'car' => true,
        'user' => true
    ];
}
