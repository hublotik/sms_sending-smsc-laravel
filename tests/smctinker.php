<?php
use App\Models\User;
use Khodja\Smsc\Smsc;

$services = include(config_path('services.php'));
echo $services['smsc']['login'];
