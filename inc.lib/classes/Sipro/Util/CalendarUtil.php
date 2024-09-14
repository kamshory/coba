<?php

namespace Sipro\Util;

class CalendarUtil
{
    private $rows = array(); 
    
    private $withNextPrev = false;
    private $type = 0;
    private $startDate;
    private $endDate;
    
    /**
     * Contructor
     *
     * @param integer $year Year
     * @param integer $month Month
     * @param integer $type
     * @param boolean $withNextPrev Create previous and next month
     */
    public function __construct($year, $month, $type = 0, $withNextPrev = false)
    {
        $this->type = $type;
        $this->withNextPrev = $withNextPrev;
        $this->createCalendarPage($year, $month);      
    }
    
    /**
     * Create calendar page
     *
     * @param integer $year Year
     * @param integer $month Month
     * @param boolean $withNextPrev Create previous and next month
     * @return array
     */
    public function createCalendarPage($year, $month)
    {   
        $this->rows = array();       
        $this->rows[0] = array();
        $raw = sprintf("%04d-%02d-01", $year, $month);
        $startTime = strtotime($raw);
        $t = date('t', $startTime);
        $endTime = $startTime + $t * 86400;
        
        if($this->type == 0)
        {
            $w1 = date('w', $startTime);
            $w2 = date('w', $endTime);
            $start = $startTime - ($w1 * 86400);
            $end = $endTime + ((7-$w2) * 86400);       
        }
        else
        {
            $w1 = date('w', $startTime);
            $w2 = date('w', $endTime);
            $start = $startTime + 86400 - ($w1 * 86400);
            $end = $endTime + 86400 + ((7-$w2) * 86400);       
        }
        
        if($this->withNextPrev)
        {
            $this->startDate = date('Y-m-d', $start);
            $this->endDate = date('Y-m-d', $end);
        }
        else
        {
            $this->startDate = date('Y-m-d', $startTime);
            $this->endDate = date('Y-m-d', $endTime);
        }
        
        
        for($i = $start, $j = 0; $i<$end; $i += 86400, $j++)
        {
            $row = floor($j / 7);
            $col = $j % 7;
            
            if(!isset($this->rows[$row]))
            {
                $this->rows[$row] = array();
            }
            $date = date('Y-m-d', $i);
            $day = date('j', $i);
            
            $printDay = false;
            if($i < $startTime)
            {
                $class = 'prev-month';
            }
            else if($i > $endTime)
            {
                $class = 'next-month';
            }
            else
            {
                $class = 'cur-month';
                $printDay = true;
            }
            if($this->withNextPrev)
            {
                $printDay = true;
            }
            
            $this->rows[$row][$col] = array(
                'date'=>$date, 
                'day'=>$day,
                'dow'=>$col,
                'class'=>$class,
                'print'=>$printDay
            );
        }
    }
    
    public function getCalendar()
    {
        return $this->rows;
    }
    
    public function getCalendarInline()
    {
        $rows = array();
        foreach($this->rows as $row)
        {
            foreach($row as $col)
            {
                $rows[] = $col;
            }
            
        }
        return $rows;
    }

    /**
     * Get the value of withNextPrev
     */ 
    public function getWithNextPrev()
    {
        return $this->withNextPrev;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }
}