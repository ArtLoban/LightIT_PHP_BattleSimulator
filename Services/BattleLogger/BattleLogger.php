<?php

namespace Services\BattleLogger;

use Services\LogWriter\LogWriterInterface;

class BattleLogger
{
    /**
     * @var LogWriterInterface
     */
    private $logWriter;

    /**
     * @var string
     */
    private static $fileName = '';

    /**
     * BattleLoggerTest constructor.
     * @param LogWriterInterface $logWriter
     */
    public function __construct(LogWriterInterface $logWriter)
    {
        $this->logWriter = $logWriter;
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

        $this->setFileName();
        $this->logWriter->write(self::$fileName, $data);
    }

    /**
     *
     */
    private function setFileName():void
    {
        self::$fileName = 'storage/logs/battle_logs/' . date('Y_m_d_His') . '.log';
    }

    /**
     * @param int $winnerId
     * @param int $counter
     */
    public function logWinner(int $winnerId = 1, int $counter = 1): void
    {
        $data = PHP_EOL . 'Победитель: Army-' . $winnerId . PHP_EOL;
        $data .= 'Количество раундов - ' . $counter . PHP_EOL;

        $this->logWriter->write(self::$fileName, $data);
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
    private function printSquad(array $squad, int $squadId = 1): string
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
     */
    public function logFight(
        int $attackingSquadArmyId = 1,
        int $attackingSquadId = 1,
        int $defendingSquadArmyId = 1,
        int $defendingSquadId = 1,
        float $damage = 1.1
    ): void
    {
        $data = 'Squad-' . $attackingSquadId . '(Army-' . $attackingSquadArmyId . ')' .' наносит ' . $damage . ' урона ' .
            'Squad-' . $defendingSquadId . '(Army-' . $defendingSquadArmyId . ')' . PHP_EOL;

        $this->logWriter->write(self::$fileName, $data);
    }

    /**
     * @param int $squadId
     * @param int $armyId
     */
    public function logSquadDestroyed(int $squadId = 1, int $armyId = 1): void
    {
        $data = '> Squad-' . $squadId . ' (Army-' . $armyId . ')' . ' уничтожен!' . PHP_EOL;

        $this->logWriter->write(self::$fileName, $data);
    }

    /**
     * @param int $armyId
     */
    public function logArmyDestroyed(int $armyId = 1): void
    {
        $data = '>>> Army-' . $armyId . ' уничтожена!' . PHP_EOL;

        $this->logWriter->write(self::$fileName, $data);
    }
}
