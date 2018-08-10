<?php

namespace App\Jobs;

use App\Billboard;
use App\Http\Services\CoordinatesService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessCoordinates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billboard;
    protected $address;

    /**
     * ProcessCoordinates constructor.
     *
     * @param \App\Billboard $billboard
     * @param $address
     */
    public function __construct(Billboard $billboard, $address)
    {
        $this->address = $address;
        $this->billboard = $billboard;
    }

    /**
     * @throws \Yandex\Geo\Exception
     * @throws \Yandex\Geo\Exception\CurlError
     * @throws \Yandex\Geo\Exception\ServerError
     */
    public function handle()
    {
        $coordinates = CoordinatesService::getCoordinates($this->address);
        $this->billboard->update([
            $this->billboard->coordinates = $coordinates
        ]);
    }
}
