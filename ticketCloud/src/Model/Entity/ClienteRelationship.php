<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClienteRelationship Entity
 *
 * @property int $id
 * @property string $ticket_number
 * @property int $cliente_id
 * @property int $cola_id
 * @property int $status_id
 * @property \Cake\I18n\FrozenTime|null $last_update
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Cola $cola
 * @property \App\Model\Entity\Status $status
 */
class ClienteRelationship extends Entity
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
        'ticket_number' => true,
        'cliente_id' => true,
        'cola_id' => true,
        'status_id' => true,
        'last_update' => true,
        'cliente' => true,
        'cola' => true,
        'status' => true,
    ];
}
