<?php
use App\Models\User;
use Khodja\Smsc\Smsc;


$status = Smsc::getStatus(14, '+79602646741', $all = 0);
$status[0];