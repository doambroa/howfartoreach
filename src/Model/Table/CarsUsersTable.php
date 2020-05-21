<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CarsUsers Model
 *
 * @property \App\Model\Table\CarsTable|\Cake\ORM\Association\BelongsTo $Cars
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CarsUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\CarsUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CarsUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CarsUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarsUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CarsUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CarsUser findOrCreate($search, callable $callback = null, $options = [])
 */
class CarsUsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cars_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['id', 'car_id', 'user_id']);

        $this->belongsTo('Cars', [
            'foreignKey' => 'car_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('car_id');

        $validator
            ->integer('user_id');

        $validator
            ->numeric('consumoCiudad')
            ->allowEmpty('consumoCiudad');

        $validator
            ->numeric('consumoAutopista')
            ->allowEmpty('consumoAutopista');

        $validator
            ->numeric('combinado')
            ->allowEmpty('combinado');

        $validator
            ->scalar('tipoConduccion')
            ->requirePresence('tipoConduccion', 'create')
            ->notEmpty('tipoConduccion');

        $validator
            ->dateTime('creado')
            ->requirePresence('creado', 'create')
            ->notEmpty('creado');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['car_id'], 'Cars'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
