<?php

namespace Flowframe\Trend;

class TrendValue
{
    public function __construct(
        public string $date,
        public mixed $aggregate,
        public mixed $cnt=null,

        public string $chrome,
        public string $safari,
        public string $edge,
        public string $firefox,

        public string $windows,
        public string $mac,
        public string $phone,
    ) {
    }
}
