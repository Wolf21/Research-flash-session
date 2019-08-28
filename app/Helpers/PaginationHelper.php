<?php

namespace App\Helpers;

class PaginationHelper
{
    // number record on each page
    const PER_PAGE = 10;

    /**
     * create pagination
     *
     * @param int $currentPage
     * @param int $lastPage
     * @return array
     */
    public static function elements($currentPage, $lastPage)
    {
        $newElements = [];
        if (($lastPage <= 8) || ($currentPage == 5 && $lastPage == 9)) {
            for ($i = 1; $i <= $lastPage; $i++) {
                $newElements[0][$i] = $i;
            }
        } else {
            $first = self::first($currentPage);
            $slider = self::slider($currentPage, $lastPage);
            $last = self::last($currentPage, $lastPage);
            return array_filter([
                $first,
                is_array($slider) ? '...' : null,
                $slider,
                is_array($last) ? '...' : null,
                $last,
            ]);
        }
        return $newElements;
    }

    /**
     * create first of pagination
     *
     * @param int $currentPage
     * @return array
     */
    protected static function first($currentPage)
    {
        $newElements = [];
        if ($currentPage > 5) {
            $newElements[1] = 1; // get page 1.
        } else {
            for ($i = 1; $i <= ($currentPage + 3 > 7 ? $currentPage + 3 : 7); $i++) {
                $newElements[$i] = $i;
            }
        }
        return $newElements;
    }

    /**
     * create slider of pagination
     *
     * @param int $currentPage
     * @param int $lastPage
     * @return array|null
     */
    protected static function slider($currentPage, $lastPage)
    {
        if ($currentPage > 5 && $currentPage <= $lastPage - 5) {
            return [
                $currentPage - 3 => $currentPage - 3,
                $currentPage - 2 => $currentPage - 2,
                $currentPage - 1 => $currentPage - 1,
                $currentPage => $currentPage,
                $currentPage + 1 => $currentPage + 1,
                $currentPage + 2 => $currentPage + 2,
                $currentPage + 3 => $currentPage + 3,
            ];
        }
        return null;
    }

    /**
     * create last of pagination
     *
     * @param int $currentPage
     * @param int $lastPage
     * @return array
     */
    protected static function last($currentPage, $lastPage)
    {
        $newElements = [];
        if ($lastPage - $currentPage >= 5) {
            $newElements[$lastPage] = $lastPage; // get last page.
        } else {
            for ($i = ($currentPage - 3 > $lastPage - 6 ? $lastPage - 6 : $currentPage - 3); $i <= $lastPage; $i++) {
                $newElements[$i] = $i;
            }
        }
        return $newElements;
    }

    /**
     * Create show number of record / total record.
     *
     * @param $object
     * @return string
     */
    public static function getNumberPage($object)
    {
        $pageNumber = '';
        if (!empty($object)) {
            $pageNumber = $object->perPage() * ($object->currentPage() - 1) + 1 . " - ";
            if ($object->perPage() * $object->currentPage() <= $object->total()) {
                $pageNumber .= $object->perPage() * $object->currentPage() . "件 / ";
            } else {
                $pageNumber .= $object->total() . "件 / ";
            }
            $pageNumber .= $object->total() . "件";
        }
        return $pageNumber;
    }
}
