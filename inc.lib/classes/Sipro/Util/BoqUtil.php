<?php

namespace Sipro\Util;

use Sipro\Entity\Data\BillOfQuantity;

class BoqUtil
{
    /**
     * Bill of Quantity
     * @var BillOfQuantity[]
     */
    private $boqs = array();

    /**
     * Temporary
     * @var array
     */
    private $tmp = array();

    /**
     * Boq Inline
     * @var array
     */
    private $boqInline = array();

    /**
     * Parent ID
     * @var integer
     */
    private $parentId;

    /**
     * Boq level
     * @var integer[]
     */
    private $boqLevel = array();

    /**
     * Disabled empty
     * @var boolean
     */
    private $disabledEmpty = false;

    /**
     * Constructor
     * @param BillOfQuantity[] $boqs
     */
    public function __construct($boqs, $parentId = 0, $disabledEmpty = false)
    {
        $this->boqs = $boqs;
        $this->parentId = $parentId;
        $this->disabledEmpty = $disabledEmpty;
        $this->createTemporary();
        $this->sortPerParent();
        $this->findReqursive();
    }

    /**
     * Create temporary data
     * @return void
     */
    private function createTemporary()
    {
        foreach($this->boqs as $boq)
        {
            $parentId = intval($boq->getParentId());
            $this->boqLevel[$boq->getBillOfQuantityId()] = $boq->getLevel();
            if(!isset($this->tmp[$parentId]))
            {
                $this->tmp[$parentId] = array();
            }
            $this->tmp[$parentId][] = $boq->valueArray(true);
        }
    }

    /**
     * Sort data by parent ID
     * @return void
     */
    private function sortPerParent()
    {
        foreach($this->tmp as $parentId=>$data)
        {
            foreach ($data as $key => $row) {
                $sort_order[$key]  = $row['sort_order'];
                $waktu_buat[$key] = $row['waktu_buat'];
            }
            
            // you can use array_column() instead of the above code
            $sort_order  = array_column($data, 'sort_order');
            $waktu_buat = array_column($data, 'waktu_buat');
            
            // Sort the data with sort_order ascending, waktu_buat ascending
            // Add $data as the last parameter, to sort by the common key
            array_multisort($sort_order, SORT_ASC, $waktu_buat, SORT_ASC, $data);

            // update temporary
            $this->tmp[$parentId] = $data;
        }
    }

    /**
     * Find recursive
     * @return void
     */
    private function findReqursive()
    {
        $this->listChild($this->parentId);
    }

    /**
     * List data by parent ID
     * @param mixed $parentId
     * @return void
     */
    private function listChild($parentId)
    {
        if(isset($this->tmp[$parentId]) && is_array($this->tmp[$parentId]))
        {
            foreach($this->tmp[$parentId] as $boq)
            {
                $this->boqInline[] = new BillOfQuantity($boq);
                $this->listChild($boq['bill_of_quantity_id']);
            }
        }
    }

    /**
     * Get options for select
     * 
     * @param integer $value Selected value
     * @param boolean $minmax
     * @return string
     */
    public function selectOption($value = null, $minmax = false)
    {
        $options = array();
        $min = isset($this->boqLevel[$this->parentId]) ? $this->boqLevel[$this->parentId] + 1 : 1;
        foreach($this->boqInline as $boq)
        {
            $disabled = $this->getAttibuteDisabled($boq);
            $selected = isset($value) && $boq->getBillOfQuantityId() == $value ? ' selected="selected"' : '';
            $minVal = intval($boq->getVolumeProyek());
            $maxVal = intval($boq->getVolume());

            $mixmaxStr = $minmax && $boq->getVolume() > 0 ? " ($minVal - $maxVal)" : "";

            $level = $boq->getLevel();
            $space = $level > $min ? str_repeat('&nbsp;', ($level-$min) * 2)."&dash;&nbsp;" : "";
            $options[] = '<option value="'.$boq->getBillOfQuantityId().'" data-volume="'.$boq->getVolume().'" data-volume-proyek="'.$boq->getVolumeProyek().'"'.$selected.$disabled.'>'.$space.$boq->getNama().$mixmaxStr.'</option>';        
        }
        return implode("\r\n", $options);
    }

    /**
     * Get disabled attribute
     * @param BillOfQuantity $boq BillOfQuantity
     * @return string
     */
    private function getAttibuteDisabled($boq)
    {
        if(!$this->disabledEmpty)
        {
            return "";
        }
        return $boq->notEmptySatuan() && $boq->notZeroVolume() ? '' : ' disabled="disabled"';
    }
}
