<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ClientesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('clientes');
        $this->setDisplayField('dni');
        $this->setPrimaryKey('id');

        $this->hasMany('ClienteRelationship', [
            'foreignKey' => 'cliente_id',
        ]);
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('dni')
            ->allowEmptyString('dni');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 100)
            ->allowEmptyString('nombre');

        $validator
            ->dateTime('last_update')
            ->allowEmptyDateTime('last_update');

        return $validator;
    }
}
