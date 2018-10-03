<?php

namespace Services\BattleLogger;


use Exception;
use Throwable;

class BattleLogger
{
    /**
     * @var string
     */
    private $file = 'battle_logs.log';

    /**
     * @var bool|resource
     */
    private $fileOpen;

    /**
     * BattleLogger constructor.
     * @param $fileOpen
     */
    public function __construct()
    {
        $this->fileOpen = $this->openFile();
    }

    /**
     * @return bool|resource
     */
    private function openFile()
    {
        try {
            return fopen($this->file,'a');
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: Failed to open stream:");
        }
    }


    /**
     * @param array $listOfArmies
     */
    public function logStart(array $listOfArmies): void
    {
        $data = PHP_EOL . '===================================================================' . PHP_EOL;
        $data .= 'New Battle' . PHP_EOL;
        $data .= date('Y-m-d H:i') . PHP_EOL . PHP_EOL;
        $data .= 'Список армий: ' . PHP_EOL;
        $data .= '-----' . PHP_EOL;
        $data .= $this->printArmyDitails($listOfArmies);

        fwrite($this->fileOpen, $data);
    }

    /**
     * @param $winnerId
     * @param $counter
     */
    public function logWinner($winnerId, $counter): void
    {
        $data = PHP_EOL . 'Победитель: Army-' . $winnerId . PHP_EOL;
        $data .= 'Количество раундов - ' . $counter . PHP_EOL;

        fwrite($this->fileOpen, $data);
        fclose($this->fileOpen);

    }

    /**
     * @param array $list
     * @return string
     */
    private function printArmyDitails(array $list): string
    {
        $data = null;
        $armyId = 1;
        foreach ($list as $army) {
            $data .= 'Army-' . $armyId . PHP_EOL;
            $data .= 'Стратегия: ' . $army['strategy'] . PHP_EOL;
            $data .= 'Отряды: ' . PHP_EOL;
            $data .= $this->printSquads($army['squads']);
            $data .= '-----' . PHP_EOL;

            $armyId++;
        }

        return $data;

    }

    /**
     * @param array $squads
     * @return string
     */
    private function printSquads(array $squads): string
    {
        $data = null;
        $squadId = 1;
        foreach ($squads as $squad) {
            $data .= $this->printSquad($squad, $squadId);
            $squadId++;
        }

        return $data;
    }

    /**
     * @param array $squad
     * @param int $squadId
     * @return string
     */
    private function printSquad(array $squad, int $squadId): string
    {
        $string = null;
        foreach ($squad as $name => $quantity) {
            $string .= 'Squad-' . $squadId . " ({$name}" . ' - ' . $quantity . ' ед.)' . PHP_EOL;
        }

        return $string;
    }

    /**
     * @param int $attackingSquadArmyId
     * @param int $attackingSquadId
     * @param int $defendingSquadArmyId
     * @param int $defendingSquadId
     * @param float $damage
     * @return string
     */
    public function logFight(
        int $attackingSquadArmyId,
        int $attackingSquadId,
        int $defendingSquadArmyId,
        int $defendingSquadId,
        float $damage
    ): void
    {
        $data = 'Squad-' . $attackingSquadId . '(Army-' . $attackingSquadArmyId . ')' .' наносит ' . $damage . ' урона ' .
            'Squad-' . $defendingSquadId . '(Army-' . $defendingSquadArmyId . ')' . PHP_EOL;

        fwrite($this->fileOpen, $data);
    }

    /**
     * @param int $squadId
     * @param int $armyId
     */
    public function logSquadDestroyed(int $squadId, int $armyId): void
    {
        $data = '> Squad-' . $squadId . ' (Army-' . $armyId . ')' . ' уничтожен!' . PHP_EOL;

        fwrite($this->fileOpen, $data);
    }

    /**
     * @param int $armyId
     */
    public function logArmyDestroyed(int $armyId): void
    {
        $data = '>>> Army-' . $armyId . ' уничтожена!' . PHP_EOL;

        fwrite($this->fileOpen, $data);
    }



}