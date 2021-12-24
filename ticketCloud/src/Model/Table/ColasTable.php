<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Colas Model
 *
 * @property \App\Model\Table\ClienteRelationshipTable&\Cake\ORM\Association\HasMany $ClienteRelationship
 * @property \App\Model\Table\VwDetalleTable&\Cake\ORM\Association\HasMany $VwDetalle
 *
 * @method \App\Model\Entity\Cola get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cola newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cola[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cola|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cola saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cola patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cola[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cola findOrCreate($search, callable $callback = null, $options = [])
 */
class ColasTable extends Table
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

        $this->setTable('colas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ClienteRelationship', [
            'foreignKey' => 'cola_id',
        ]);
        $this->hasMany('VwDetalle', [
            'foreignKey' => 'cola_id',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 100)
            ->allowEmptyString('nombre');

        $validator
            ->integer('tiempo_duracion_min')
            ->allowEmptyString('tiempo_duracion_min');

        $validator
            ->dateTime('last_update')
            ->allowEmptyDateTime('last_update');

        return $validator;
    }
}
