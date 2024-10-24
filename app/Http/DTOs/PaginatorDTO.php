<?php

namespace App\Http\DTOs; 

class PaginatorDTO
{
    public  $Data;
    public readonly int $CurrentPage;
    public readonly int $PerPage;
    public readonly string $Total;
    public readonly string $LastPage;

    public function __construct($data,$currentPage,$perPage,$total,$lastPage) 
    {
        $this->Data = $data;
        $this->CurrentPage = $currentPage;
        $this->PerPage = $perPage;
        $this->Total = $total;
        $this->LastPage = $lastPage;
    }

    public static function Pagination($data,$currentPage,$perPage,$total,$lastPage)
    {
        $pagination = new self($data,$currentPage,$perPage,$total,$lastPage);
        return [
            'data'=> $pagination->Data,
            'current_page' => $pagination->CurrentPage,
            'per_page' => $pagination->PerPage,
            'total'=>$pagination->Total,
            'last_page' =>$pagination->LastPage
        ];
    }

}


?>