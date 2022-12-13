<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class stataDeleteLogCommand extends Command
{
    protected $signature = 'stata:delete-log';

    protected $description = '주기적인 stata 실행 로그 삭제';

    public function handle()
    {
        Storage::deleteDirectory( './storage/stata/do');
        Storage::deleteDirectory( './storage/stata/log');
        Storage::deleteDirectory( './storage/stata/result');

        Storage::makeDirectory( './storage/stata/do');
        Storage::makeDirectory( './storage/stata/log');
        Storage::makeDirectory( './storage/stata/result');
    }
}
