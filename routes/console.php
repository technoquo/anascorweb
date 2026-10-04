<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:recalcular-morosidad')->dailyAt('06:00');
