<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClienteRelationship Model
 *
 * @property \App\Model\Table\ClientesTable&\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\ColasTable&\Cake\ORM\Association\BelongsTo $Colas
 * @property \App\Model\Table\StatusTable&\Cake\ORM\Association\BelongsTo $Status
 *
 * @method \App\Model\Entity\ClienteRelationship get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClienteRelationship newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClienteRelationship[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClienteRelationship|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClienteRelationship saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClienteRelationship patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClienteRelationship[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClienteRelationship findOrCreate($search, callable $callback = null, $options = [])
 */
class ClienteRelationshipTable extends Table
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

        $this->setTable('cliente_relationship');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Colas', [
            'foreignKey' => 'cola_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Status', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER',
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
            ->scalar('ticket_number')
            ->maxLength('ticket_number', 45)
            ->requirePresence('ticket_number', 'create')
            ->notEmptyString('ticket_number');

        $validator
            ->dateTime('last_update')
            ->allowEmptyDateTime('last_update');

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
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['cola_id'], 'Colas'));
        $rules->add($rules->existsIn(['status_id'], 'Status'));

        return $rules;
    }
}
