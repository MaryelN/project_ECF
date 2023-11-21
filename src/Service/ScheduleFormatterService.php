<?php

namespace App\Service;

use App\Repository\ScheduleRepository;

class ScheduleFormatterService
{
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function getFormattedSchedules(): array
    {
        $schedules = $this->scheduleRepository->findBy([], ['id' => 'ASC']);

        $formattedSchedules = array_map(function ($schedule) {
            return [
                'dayName' => $schedule->getDayName(),
                'openingAm' => $schedule->getOpeningAm()->format('H:i'),
                'closingAm' => $schedule->getClosingAm()->format('H:i'),
                'openingPm' => $schedule->getOpeningPm()->format('H:i'),
                'closingPm' => $schedule->getClosingPm()->format('H:i'),
            ];
        }, $schedules);

        return $formattedSchedules;
    }
}
