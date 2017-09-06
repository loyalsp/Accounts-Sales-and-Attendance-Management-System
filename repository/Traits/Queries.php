<?php
namespace App\Repositories;
/**
 * Class Queries
 * @package App
 */
trait Queries
{
    /**
     * @return mixed
     */
    public function getRecordsByCurrentDate()
    {
        return $this
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->whereDay('created_at', date('d'));
    }

    /**
     * @param $dateFrom
     * @param $dateTo
     * @return mixed
     */
    public function getRecords($dateFrom, $dateTo)
    {
        return
            $this
                ->whereBetween('created_at', [
                    $dateFrom." 00:00:00",
                    $dateTo." 23:59:59"
                ]);
    }

    /**
     * @return mixed
     */
    public function getRecordsByCurrentMonth()
    {
        return $this
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'));
    }


}