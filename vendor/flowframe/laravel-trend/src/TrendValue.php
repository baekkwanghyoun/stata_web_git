<?php

namespace Flowframe\Trend;

class TrendValue
{
    public function __construct(
        public string $date,
        public mixed $aggregate,
        public mixed $cnt=null,

        public string $chrome,
        public string $mozilla,
        public string $edge,
        public string $firefox,

        public string $windows,
        public string $ios,
        public string $phone, // 폰
    ) {
    }
}
