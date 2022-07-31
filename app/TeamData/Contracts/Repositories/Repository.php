<?php

namespace App\TeamData\Contracts\Repositories;

interface Repository
{
    public function grades(): GradeRepository;

    public function positions(): PositionRepository;

    public function employees(): EmployeeRepository;

    public function vacations(): VacationRepository;
}
