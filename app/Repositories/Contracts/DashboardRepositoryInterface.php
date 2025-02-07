<?php

namespace App\Repositories\Contracts;

interface DashboardRepositoryInterface
{
   public function loanDates();
   public function loanCounts();
   public function topMenus();
}