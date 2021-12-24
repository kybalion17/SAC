<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Status Entity
 *
 * @property int $id
 * @property string|null $nombre
 * @property \Cake\I18n\FrozenTime|null $last_update
 *
 * @property \App\Model\Entity\ClienteRelationship[] $cliente_relationship
 * @property \App\Model\Entity\VwDetalle[] $vw_detalle
 */
class Status extends Entity
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
        'nombre' => true,
        'last_update' => true,
        'cliente_relationship' => true,
        'vw_detalle' => true,
    ];
}
